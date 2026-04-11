<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegistrationController extends Controller
{
    public function chooseRole(): Response
    {
        return Inertia::render('RegisterRoleChoice');
    }

    public function showPlayerForm(): Response
    {
        return Inertia::render('RegisterPlayer');
    }

    public function showAgentForm(): Response
    {
        return Inertia::render('RegisterAgent');
    }

    public function showClubForm(): Response
    {
        return Inertia::render('RegisterClub');
    }

    public function registerPlayer(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'free_agent_proof_type' => ['required', 'string', 'max:120'],
            'free_agent_proof_reference' => ['required', 'string', 'max:255'],
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'joueur',
            'locale' => 'fr',
            'is_verified' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('player_profiles')->insert([
            'user_id' => $userId,
            'declares_free_agent' => true,
            'free_agent_proof_type' => $validated['free_agent_proof_type'],
            'free_agent_proof_reference' => $validated['free_agent_proof_reference'],
            'verification_status' => 'en_attente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('joueur.dashboard');
    }

    public function registerAgent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'identity_document_type' => ['required', 'string', 'max:120'],
            'identity_document_reference' => ['required', 'string', 'max:255'],
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'agent_recruteur',
            'locale' => 'fr',
            'is_verified' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('agent_recruiter_profiles')->insert([
            'user_id' => $userId,
            'organization_name' => $validated['organization_name'] ?? null,
            'license_number' => $validated['license_number'],
            'identity_document_type' => $validated['identity_document_type'],
            'identity_document_reference' => $validated['identity_document_reference'],
            'verification_status' => 'en_attente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('agent.dashboard');
    }

    public function registerClub(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'club_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:120'],
            'registration_number' => ['required', 'string', 'max:255'],
            'identity_document_type' => ['required', 'string', 'max:120'],
            'identity_document_reference' => ['required', 'string', 'max:255'],
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'club',
            'locale' => 'fr',
            'is_verified' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('club_profiles')->insert([
            'user_id' => $userId,
            'club_name' => $validated['club_name'],
            'country' => $validated['country'],
            'registration_number' => $validated['registration_number'],
            'identity_document_type' => $validated['identity_document_type'],
            'identity_document_reference' => $validated['identity_document_reference'],
            'verification_status' => 'en_attente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('club.dashboard');
    }
}
