<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ContactRequest;
use App\Models\PlayerProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();

        $requests = ContactRequest::query()
            ->with([
                'playerProfile:id,user_id,first_name,last_name,club_user_id,agent_user_id',
                'requester:id,name',
                'recipient:id,name',
            ])
            ->where(function ($query) use ($currentUser) {
                $query->where('requester_user_id', $currentUser->id)
                    ->orWhere('recipient_user_id', $currentUser->id);
            })
            ->latest()
            ->get()
            ->map(fn (ContactRequest $cr) => [
                'id' => $cr->id,
                'status' => $cr->status,
                'message_initial' => $cr->message_initial,
                'responded_at' => $cr->responded_at?->toIso8601String(),
                'created_at' => $cr->created_at?->toIso8601String(),
                'player' => $cr->playerProfile ? [
                    'id' => $cr->playerProfile->id,
                    'name' => trim($cr->playerProfile->first_name . ' ' . $cr->playerProfile->last_name),
                    'status' => $cr->playerProfile->contract_status,
                ] : null,
                'requester' => $cr->requester ? ['id' => $cr->requester->id, 'name' => $cr->requester->name] : null,
                'recipient' => $cr->recipient ? ['id' => $cr->recipient->id, 'name' => $cr->recipient->name] : null,
                'is_recipient' => $cr->recipient_user_id === $currentUser->id,
            ])
            ->values();

        return response()->json(['success' => true, 'data' => $requests]);
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();

        $validated = $request->validate([
            'player_profile_id' => ['required', 'integer', 'exists:player_profiles,id'],
            'message_initial' => ['nullable', 'string', 'max:1000'],
        ]);

        $playerProfile = PlayerProfile::query()
            ->with(['club', 'agent', 'user'])
            ->findOrFail($validated['player_profile_id']);

        try {
            $recipient = $this->resolveRecipient($playerProfile);
        } catch (\RuntimeException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }

        $contactRequest = ContactRequest::query()->updateOrCreate(
            [
                'player_profile_id' => $playerProfile->id,
                'requester_user_id' => $currentUser->id,
                'recipient_user_id' => $recipient->id,
            ],
            [
                'status' => 'en_attente',
                'message_initial' => trim((string) ($validated['message_initial'] ?? '')),
                'responded_at' => null,
            ]
        );

        return response()->json(['success' => true, 'data' => $contactRequest], 201);
    }

    public function updateStatus(Request $request, ContactRequest $contactRequest)
    {
        $currentUser = $request->user();

        abort_unless($contactRequest->recipient_user_id === $currentUser->id, 403);

        $validated = $request->validate([
            'status' => ['required', 'in:acceptee,refusee'],
        ]);

        $contactRequest->update([
            'status' => $validated['status'],
            'responded_at' => now(),
        ]);

        // Acceptation → ouvre la messagerie entre les deux parties
        if ($validated['status'] === 'acceptee') {
            $ids = collect([$contactRequest->requester_user_id, $contactRequest->recipient_user_id])
                ->sort()
                ->values();

            Conversation::query()->firstOrCreate([
                'participant_1_id' => $ids[0],
                'participant_2_id' => $ids[1],
            ]);
        }

        return response()->json(['success' => true, 'data' => $contactRequest->fresh()]);
    }

    private function resolveRecipient(PlayerProfile $playerProfile): User
    {
        if ($playerProfile->club_user_id) {
            return $playerProfile->club ?? throw new \RuntimeException('Club introuvable pour ce profil.');
        }
        if ($playerProfile->agent_user_id) {
            return $playerProfile->agent ?? throw new \RuntimeException('Agent introuvable pour ce profil.');
        }
        return $playerProfile->user ?? throw new \RuntimeException('Joueur introuvable pour ce profil.');
    }
}