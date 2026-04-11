<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\Player;
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
            ->with(['player:id,name,initials,status', 'requester:id,name', 'recipient:id,name'])
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
                'player' => $request->player ? [
                    'id' => $request->player->id,
                    'name' => $request->player->name,
                    'initials' => $request->player->initials,
                    'status' => $request->player->status,
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
            'player_id' => ['required', 'integer', 'exists:players,id'],
            'message_initial' => ['nullable', 'string', 'max:1000'],
        ]);

        $player = Player::query()->with(['owner', 'club', 'agent'])->findOrFail($validated['player_id']);
        $recipient = $this->resolveRecipient($player);

        ContactRequest::query()->updateOrCreate(
            [
                'player_id' => $player->id,
                'requester_user_id' => $currentUser->id,
                'recipient_user_id' => $recipient->id,
            ],
            [
                'status' => 'en_attente',
                'message_initial' => trim((string) ($validated['message_initial'] ?? '')),
                'responded_at' => null,
            ]
        );

        return back();
    }

    public function updateStatus(Request $request, ContactRequest $contactRequest): RedirectResponse
    {
        $currentUser = $this->resolveCurrentUser();
        abort_unless($contactRequest->recipient_user_id === $currentUser->id, 403);

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
        return User::query()->find(1) ?? User::query()->firstOrFail();
    }

    private function resolveRecipient(Player $player): User
    {
        if ($player->status === 'Sous contrat') {
            return $player->club
                ?? User::query()->where('role', 'club')->first()
                ?? User::query()->firstOrFail();
        }

        if ($player->status === 'Avec agent') {
            return $player->agent
                ?? User::query()->where('role', 'agent_recruteur')->first()
                ?? User::query()->firstOrFail();
        }

        return $player->owner
            ?? User::query()->where('role', 'joueur')->first()
            ?? User::query()->firstOrFail();
    }
}
