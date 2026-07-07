<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Inscription
     */
    public function register(Request $request)
{
    $validated = $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', Password::defaults()],
        'role'     => ['required', 'in:joueur,club,agent,recruteur,admin'],
    ]);

    $user = User::create([
        'name'        => $validated['name'],
        'email'       => $validated['email'],
        'password'    => $validated['password'],
        'role'        => $validated['role'],
        'status'      => 'active',
        'is_verified' => false,
    ]);

    // Création automatique du profil selon le rôle
   match ($validated['role']) {
    'joueur'    => $user->playerProfile()->create([
        'first_name'      => explode(' ', $validated['name'])[0],
        'last_name'       => explode(' ', $validated['name'])[1] ?? '',
        'position'        => 'ST',
        'strong_foot'     => 'right',
        'contract_status' => 'free',
        'nationality'     => 'AFR',
        'date_of_birth'   => now()->subYears(20),
    ]),
    'club'      => $user->clubProfile()->create([
        'club_name' => $validated['name'],
    ]),
    'agent'     => $user->agentProfile()->create([]),
    'recruteur' => $user->recruiterProfile()->create([]),
    default     => null,
};

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Compte créé avec succès',
        'token'   => $token,
        'user'    => $user,
    ], 201);
}

    /**
     * Connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Email ou mot de passe incorrect.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie.',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Utilisateur connecté
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie.'
        ]);
    }
}