<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleProfilesSeeder extends Seeder
{
    public function run(): void
    {
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

        DB::table('player_profiles')->updateOrInsert(
            ['user_id' => $joueur->id],
            [
                'declares_free_agent' => true,
                'free_agent_proof_type' => 'attestation_federation',
                'free_agent_proof_reference' => 'AFF-2026-001',
                'verification_status' => 'verifie',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

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

        Player::query()->where('status', 'Libre')->update([
            'owner_user_id' => $joueur->id,
            'club_user_id' => null,
            'agent_user_id' => null,
        ]);

        Player::query()->where('status', 'Sous contrat')->update([
            'club_user_id' => $club->id,
        ]);

        Player::query()->where('status', 'Avec agent')->update([
            'agent_user_id' => $agent->id,
        ]);
    }
}
