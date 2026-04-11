<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerVideo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClubPlayerVideoController extends Controller
{
    public function store(Request $request, Player $player): RedirectResponse
    {
        $currentUser = $this->resolveCurrentUser();
        abort_unless($currentUser->role === 'club', 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:2048'],
        ]);

        PlayerVideo::query()->create([
            'player_id' => $player->id,
            'uploaded_by_user_id' => $currentUser->id,
            'title' => trim($validated['title']),
            'video_url' => trim($validated['video_url']),
        ]);

        return back();
    }

    private function resolveCurrentUser(): User
    {
        return User::query()->find(1) ?? User::query()->firstOrFail();
    }
}
