<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // GET /api/v1/conversations/{conversation}/messages
    public function index(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $messages = $conversation->messages()
            ->with('sender:id,name')
            ->orderBy('created_at')
            ->get();

        // Marquer comme lus les messages reçus par l'utilisateur courant
        $conversation->messages()
            ->where('sender_id', '!=', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['success' => true, 'data' => $messages]);
    }

    // POST /api/v1/conversations/{conversation}/messages
    public function store(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => trim($validated['body']),
            'original_language' => $request->user()->locale ?? 'fr',
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json([
            'success' => true,
            'data' => $message->load('sender:id,name'),
        ], 201);
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