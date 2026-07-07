<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerProfileRequest;
use App\Models\PlayerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlayerProfileController extends Controller
{
    // GET /api/v1/players
    public function index(Request $request)
    {
        $players = PlayerProfile::with('user')
            ->when($request->position, fn($q) => $q->where('position', $request->position))
            ->when($request->nationality, fn($q) => $q->where('nationality', $request->nationality))
            ->when($request->contract_status, fn($q) => $q->where('contract_status', $request->contract_status))
            ->when($request->strong_foot, fn($q) => $q->where('strong_foot', $request->strong_foot))
            ->when($request->available, fn($q) => $q->where('available', true))
            ->orderByDesc('visibility_score')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data'    => $players->items(),
            'meta'    => [
                'current_page' => $players->currentPage(),
                'per_page'     => $players->perPage(),
                'total'        => $players->total(),
                'last_page'    => $players->lastPage(),
            ],
        ]);
    }

    // GET /api/v1/players/me
    public function me(Request $request)
    {
        $profile = $request->user()->playerProfile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil joueur non trouvé.',
            ], 404);
        }

        $profile->load('videos');

        return response()->json([
            'success' => true,
            'data'    => $profile,
        ]);
    }

    // PUT /api/v1/players/me
    public function updateMe(PlayerProfileRequest $request)
    {
        $profile = $request->user()->playerProfile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil joueur non trouvé.',
            ], 404);
        }

        $profile->update($request->validated());

        return response()->json([
            'success' => true,
            'data'    => $profile->fresh()->load('videos'),
        ]);
    }

    // GET /api/v1/players/{playerProfile}
    public function show(PlayerProfile $playerProfile)
    {
        $playerProfile->load('user', 'videos');

        return response()->json([
            'success' => true,
            'data'    => $playerProfile,
        ]);
    }

    // POST /api/v1/players
    public function store(PlayerProfileRequest $request)
    {
        if ($request->user()->playerProfile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil joueur déjà existant.',
            ], 422);
        }

        $profile = PlayerProfile::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'data'    => $profile,
        ], 201);
    }

    // PUT /api/v1/players/{playerProfile}
    public function update(PlayerProfileRequest $request, PlayerProfile $playerProfile)
    {
        if ($playerProfile->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $playerProfile->update($request->validated());

        return response()->json([
            'success' => true,
            'data'    => $playerProfile->fresh(),
        ]);
    }

    // DELETE /api/v1/players/{playerProfile}
    public function destroy(PlayerProfile $playerProfile)
    {
        if ($playerProfile->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Forbidden'], 403);
        }

        $playerProfile->delete();

        return response()->json(['success' => true], 204);
    }

//METHODE D'UPLOAD PHOTO
    public function uploadPhoto(Request $request)
{
    $request->validate([
        'photo' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:4096',
        ],
    ]);

    $profile = $request->user()->playerProfile;

    if (! $profile) {
        return response()->json([
            'success' => false,
            'message' => 'Profil joueur introuvable.',
        ], 404);
    }

    if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
        Storage::disk('public')->delete($profile->photo);
    }

    $file = $request->file('photo');

    $path = $file->storeAs(
        'players',
        Str::uuid().'.'.$file->extension(),
        'public'
    );

    $profile->update([
        'photo' => $path,
    ]);

    return response()->json([
        'success' => true,
        'photo' => asset('storage/'.$path),
    ]);
}
}