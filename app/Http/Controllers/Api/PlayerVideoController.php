<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerVideoRequest;
use App\Models\PlayerVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerVideoController extends Controller
{
    /**
     * Liste des vidéos du joueur connecté.
     */
    public function index(Request $request)
    {
        $profile = $request->user()->playerProfile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil joueur introuvable.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile->videos()->orderBy('order')->get(),
        ]);
    }

    /**
     * Upload d'une nouvelle vidéo.
     */
    public function store(PlayerVideoRequest $request)
    {
        $profile = $request->user()->playerProfile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil joueur introuvable.',
            ], 404);
        }

        $path = $request->file('video')->store('player-videos', 'public');

        $video = PlayerVideo::create([
            'player_profile_id' => $profile->id,
            'title'             => $request->title,
            's3_key'            => $path,
            'is_highlight'      => $request->boolean('is_highlight'),
            'order'             => $profile->videos()->count(),
        ]);

        return response()->json([
            'success' => true,
            'data'    => $video,
        ], 201);
    }

    /**
     * Affiche une vidéo.
     */
    public function show(PlayerVideo $playerVideo)
    {
        return response()->json([
            'success' => true,
            'data'    => $playerVideo,
        ]);
    }

    /**
     * Supprime une vidéo.
     */
    public function destroy(Request $request, PlayerVideo $playerVideo)
    {
        if ($playerVideo->playerProfile->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden',
            ], 403);
        }

        Storage::disk('public')->delete($playerVideo->s3_key);

        $playerVideo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vidéo supprimée.',
        ]);
    }
}