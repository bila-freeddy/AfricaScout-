<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\PlayerProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactRequestController extends Controller
{
    public function index(): Response
    {
        $currentUser = $this->resolveCurrentUser();

        $requests = ContactRequest::query()
            ->with([
                'playerProfile:id,user_id,first_name,last_name,contract_status',
                'requester:id,name',
                'recipient:id,name',
            ])
            ->where(function ($query) use ($currentUser) {
                $query->where('requester_user_id', $currentUser->id)
                    ->orWhere('recipient_user_id', $currentUser->id);
            })
            ->latest()
            ->get()
            ->map(fn (ContactRequest $request) => [
                'id' => $request->id,
                'status' => $request->status,
                'message_initial' => $request->message_initial,
                'responded_at' => $request->responded_at?->toIso8601String(),
                'created_at' => $request->created_at?->toIso8601String(),

                'player' => $request->playerProfile ? [
                    'id' => $request->playerProfile->id,
                    'name' => trim(
                        $request->playerProfile->first_name . ' ' .
                        $request->playerProfile->last_name
                    ),
                    'status' => $request->playerProfile->contract_status,
                ] : null,

                'requester' => $request->requester ? [
                    'id' => $request->requester->id,
                    'name' => $request->requester->name,
                ] : null,

                'recipient' => $request->recipient ? [
                    'id' => $request->recipient->id,
                    'name' => $request->recipient->name,
                ] : null,

                'is_recipient' => $request->recipient_user_id === $currentUser->id,
            ])
            ->values();

        return Inertia::render('ContactRequests', [
            'currentUserId' => $currentUser->id,
            'requests' => $requests,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $currentUser = $this->resolveCurrentUser();

        $validated = $request->validate([
            'player_profile_id' => [
                'required',
                'integer',
                'exists:player_profiles,id',
            ],
            'message_initial' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $playerProfile = PlayerProfile::query()
            ->with(['club', 'agent', 'user'])
            ->findOrFail($validated['player_profile_id']);

        $recipient = $this->resolveRecipient($playerProfile);

        ContactRequest::query()->updateOrCreate(
            [
                'player_profile_id' => $playerProfile->id,
                'requester_user_id' => $currentUser->id,
                'recipient_user_id' => $recipient->id,
            ],
            [
                'status' => 'en_attente',
                'message_initial' => trim(
                    (string) ($validated['message_initial'] ?? '')
                ),
                'responded_at' => null,
            ]
        );

        return back();
    }

    public function updateStatus(
        Request $request,
        ContactRequest $contactRequest
    ): RedirectResponse {
        $currentUser = $this->resolveCurrentUser();

        abort_unless(
            $contactRequest->recipient_user_id === $currentUser->id,
            403
        );

        $validated = $request->validate([
            'status' => ['required', 'in:acceptee,refusee'],
        ]);

        $contactRequest->update([
            'status' => $validated['status'],
            'responded_at' => now(),
        ]);

        return back();
    }

    private function resolveCurrentUser(): User
    {
        return User::query()->find(1)
            ?? User::query()->firstOrFail();
    }

    private function resolveRecipient(PlayerProfile $playerProfile): User
    {
        if ($playerProfile->contract_status === 'contracted') {
            return $playerProfile->club
                ?? User::query()->where('role', 'club')->first()
                ?? User::query()->firstOrFail();
        }

        if ($playerProfile->contract_status === 'with_agent') {
            return $playerProfile->agent
                ?? User::query()
                    ->where('role', 'agent_recruteur')
                    ->first()
                ?? User::query()->firstOrFail();
        }

        return $playerProfile->user
            ?? User::query()->where('role', 'joueur')->first()
            ?? User::query()->firstOrFail();
    }
}
