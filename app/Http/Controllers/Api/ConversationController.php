<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    // GET /api/v1/conversations
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $conversations = Conversation::query()
            ->forUser($userId)
            ->with(['participantOne:id,name', 'participantTwo:id,name'])
            ->withCount(['messages as unread_count' => function ($q) use ($userId) {
                $q->where('is_read', false)->where('sender_id', '!=', $userId);
            }])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function (Conversation $c) use ($userId) {
                $other = $c->otherParticipant($userId);
                return [
                    'id' => $c->id,
                    'other_user' => $other ? ['id' => $other->id, 'name' => $other->name] : null,
                    'subject' => $c->subject,
                    'last_message_at' => $c->last_message_at?->toIso8601String(),
                    'unread_count' => $c->unread_count,
                ];
            });

        return response()->json(['success' => true, 'data' => $conversations]);
    }

    // GET /api/v1/conversations/{conversation}
    public function show(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $conversation->load(['participantOne:id,name', 'participantTwo:id,name']);

        return response()->json(['success' => true, 'data' => $conversation]);
    }

    private function authorizeParticipant(Request $request, Conversation $conversation): void
    {
        $userId = $request->user()->id;
        abort_unless(
            in_array($userId, [$conversation->participant_1_id, $conversation->participant_2_id]),
            403
        );
    }
}