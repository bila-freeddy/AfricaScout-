<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlayerProfile;
use Illuminate\Http\Request;

class PlayerAssignmentController extends Controller
{
    // POST /api/v1/players/{playerProfile}/assign-club
    // Un club revendique directement un joueur libre. Pas de confirmation
    // nécessaire côté club (c'est lui qui inscrit/gère).
    public function assignClub(Request $request, PlayerProfile $playerProfile)
    {
        abort_unless($request->user()->role === 'club', 403, 'Réservé aux clubs.');

        if ($playerProfile->club_user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Ce joueur est déjà lié à un club.',
            ], 422);
        }

        $playerProfile->update(['club_user_id' => $request->user()->id]);

        return response()->json([
            'success' => true,
            'data'    => $playerProfile->fresh(),
        ]);
    }

    // POST /api/v1/players/{playerProfile}/assign-agent
    // Un agent propose une représentation à un joueur LIBRE (pas sous contrat).
    // N'active rien tant que le joueur n'a pas confirmé.
    public function assignAgent(Request $request, PlayerProfile $playerProfile)
    {
        abort_unless(
            in_array($request->user()->role, ['agent', 'recruteur']),
            403,
            'Réservé aux agents.'
        );

        if ($playerProfile->club_user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Ce joueur est sous contrat, passez par son club.',
            ], 422);
        }

        if ($playerProfile->agent_user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Ce joueur a déjà un agent.',
            ], 422);
        }

        $playerProfile->update(['pending_agent_user_id' => $request->user()->id]);

        return response()->json([
            'success' => true,
            'message' => 'Proposition envoyée, en attente de confirmation du joueur.',
        ]);
    }

    // POST /api/v1/players/me/confirm-agent
    public function confirmAgent(Request $request)
    {
        $profile = $request->user()->playerProfile;

        abort_if(!$profile || !$profile->pending_agent_user_id, 404, 'Aucune proposition en attente.');

        $profile->update([
            'agent_user_id'         => $profile->pending_agent_user_id,
            'pending_agent_user_id' => null,
        ]);

        return response()->json(['success' => true, 'data' => $profile->fresh()]);
    }

    // POST /api/v1/players/me/reject-agent
    public function rejectAgent(Request $request)
    {
        $profile = $request->user()->playerProfile;

        abort_if(!$profile || !$profile->pending_agent_user_id, 404, 'Aucune proposition en attente.');

        $profile->update(['pending_agent_user_id' => null]);

        return response()->json(['success' => true]);
    }
}