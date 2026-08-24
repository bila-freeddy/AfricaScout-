<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleProfilesSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Utilisateurs de démonstration
        |--------------------------------------------------------------------------
        */

        $joueur = User::query()->updateOrCreate(
            ['email' => 'joueur@example.com'],
            [
                'name' => 'Joueur Libre Demo',
                'password' => Hash::make('password'),
                'role' => 'joueur',
                'locale' => 'fr',
                'is_verified' => true,
            ]
        );

        $agent = User::query()->updateOrCreate(
            ['email' => 'agent@example.com'],
            [
                'name' => 'Agent Recruteur Demo',
                'password' => Hash::make('password'),
                'role' => 'agent_recruteur',
                'locale' => 'fr',
                'is_verified' => true,
            ]
        );

        $club = User::query()->updateOrCreate(
            ['email' => 'club@example.com'],
            [
                'name' => 'Club Demo',
                'password' => Hash::make('password'),
                'role' => 'club',
                'locale' => 'fr',
                'is_verified' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Profil du joueur libre
        |--------------------------------------------------------------------------
        */

        DB::table('player_profiles')->updateOrInsert(
            ['user_id' => $joueur->id],
            [
                'declares_free_agent' => true,
                'free_agent_proof_type' => 'attestation_federation',
                'free_agent_proof_reference' => 'AFF-2026-001',
                'verification_status' => 'verifie',

                'first_name' => 'Joueur',
                'last_name' => 'Libre Demo',
                'strong_foot' => 'Droit',
                'contract_status' => 'free',

                'matches_played' => 0,
                'goals' => 0,
                'assists' => 0,
                'yellow_cards' => 0,
                'red_cards' => 0,

                'is_premium' => false,
                'available' => true,
                'visibility_score' => 0,

                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Profil agent recruteur
        |--------------------------------------------------------------------------
        */

        DB::table('agent_recruiter_profiles')->updateOrInsert(
            ['user_id' => $agent->id],
            [
                'organization_name' => 'Africa Elite Scouting',
                'license_number' => 'AGT-77821',
                'identity_document_type' => 'carte_identite',
                'identity_document_reference' => 'ID-AGENT-2026',
                'verification_status' => 'verifie',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Profil club
        |--------------------------------------------------------------------------
        */

        DB::table('club_profiles')->updateOrInsert(
            ['user_id' => $club->id],
            [
                'club_name' => 'FC Dakar Vision',
                'country' => 'Senegal',
                'registration_number' => 'CLUB-SN-2039',
                'identity_document_type' => 'registre_commerce',
                'identity_document_reference' => 'RCCM-SN-2039',
                'verification_status' => 'verifie',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}