<?php

namespace App\Http\Controllers;

use App\Models\PlayerProfile;
use App\Models\PlayerVideo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClubPlayerVideoController extends Controller
{
    /**
     * Permet à un club d'ajouter une vidéo au profil d'un joueur
     * dont il est responsable.
     *
     * Un joueur libre peut également gérer ses propres vidéos
     * via PlayerVideoController (API).
     */
    public function store(
        Request $request,
        PlayerProfile $playerProfile
    ): RedirectResponse {
        $currentUser = $this->resolveCurrentUser();

        // Le club doit être le club associé au profil du joueur.
        abort_unless(
            $currentUser->role === 'club'
            && $playerProfile->club_user_id === $currentUser->id,
            403
        );

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:2048'],
        ]);

        PlayerVideo::query()->create([
            'player_profile_id' => $playerProfile->id,
            'title' => trim($validated['title']),
            's3_key' => trim($validated['video_url']),
        ]);

        return back();
    }

    /**
     * Retourne l'utilisateur courant.
     *
     * Méthode temporaire utilisée pendant la phase actuelle.
     * Elle pourra être remplacée par Auth::user() lorsque
     * l'authentification Web sera complètement branchée.
     */
    private function resolveCurrentUser(): User
    {
        return User::query()->find(1)
            ?? User::query()->firstOrFail();
    }
}