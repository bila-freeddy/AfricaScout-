<?php

namespace Database\Seeders;

use App\Models\PlayerProfile;
use App\Models\PlayerVideo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            [
                'first_name' => 'Amadou',
                'last_name' => 'Konaté',
                'nationality' => 'Mali',
                'position' => 'Milieu défensif',
                'strong_foot' => 'Droit',
                'height_cm' => 185,
                'weight_kg' => 78,
                'contract_status' => 'free',
                'available' => true,
                'matches_played' => 32,
                'goals' => 4,
                'assists' => 8,
                'yellow_cards' => 6,
                'red_cards' => 0,
                'videos' => [
                    'Highlights Saison 2025/26',
                    'Compétences défensives',
                ],
            ],
            [
                'first_name' => 'Kwame',
                'last_name' => 'Mensah',
                'nationality' => 'Ghana',
                'position' => 'Attaquant',
                'strong_foot' => 'Gauche',
                'height_cm' => 178,
                'weight_kg' => 72,
                'contract_status' => 'contracted',
                'available' => false,
                'matches_played' => 28,
                'goals' => 15,
                'assists' => 7,
                'yellow_cards' => 3,
                'red_cards' => 0,
                'videos' => [
                    'Top Buts 2025',
                ],
            ],
            [
                'first_name' => 'Youssef',
                'last_name' => 'Benali',
                'nationality' => 'Maroc',
                'position' => 'Gardien de but',
                'strong_foot' => 'Droit',
                'height_cm' => 192,
                'weight_kg' => 85,
                'contract_status' => 'agent',
                'available' => true,
                'matches_played' => 30,
                'goals' => 0,
                'assists' => 1,
                'yellow_cards' => 2,
                'red_cards' => 0,
                'videos' => [
                    'Arrêts Saison 2025',
                ],
            ],
            [
                'first_name' => 'Emmanuel',
                'last_name' => 'Okafor',
                'nationality' => 'Nigeria',
                'position' => 'Défenseur central',
                'strong_foot' => 'Droit',
                'height_cm' => 188,
                'weight_kg' => 82,
                'contract_status' => 'free',
                'available' => true,
                'matches_played' => 26,
                'goals' => 2,
                'assists' => 3,
                'yellow_cards' => 4,
                'red_cards' => 1,
                'videos' => [
                    'Highlights Défensifs',
                ],
            ],
            [
                'first_name' => 'Abdoulaye',
                'last_name' => 'Diallo',
                'nationality' => 'Sénégal',
                'position' => 'Ailier droit',
                'strong_foot' => 'Les deux',
                'height_cm' => 174,
                'weight_kg' => 68,
                'contract_status' => 'contracted',
                'available' => false,
                'matches_played' => 24,
                'goals' => 9,
                'assists' => 12,
                'yellow_cards' => 2,
                'red_cards' => 0,
                'videos' => [
                    'Dribbles et Vitesse',
                ],
            ],
            [
                'first_name' => 'Kofi',
                'last_name' => 'Asante',
                'nationality' => "Côte d'Ivoire",
                'position' => 'Milieu offensif',
                'strong_foot' => 'Gauche',
                'height_cm' => 176,
                'weight_kg' => 70,
                'contract_status' => 'agent',
                'available' => true,
                'matches_played' => 29,
                'goals' => 11,
                'assists' => 14,
                'yellow_cards' => 3,
                'red_cards' => 0,
                'videos' => [
                    'Vision de jeu 2025',
                ],
            ],
        ];

        foreach ($players as $data) {
            $videos = $data['videos'];
            unset($data['videos']);

            /*
            |--------------------------------------------------------------------------
            | Création du compte utilisateur du joueur
            |--------------------------------------------------------------------------
            */

            $email = strtolower(
                $data['first_name'] . '.' . $data['last_name']
            ) . '@example.com';

            $user = User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'password' => Hash::make('password'),
                    'role' => 'joueur',
                    'locale' => 'fr',
                    'is_verified' => true,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Création du profil joueur
            |--------------------------------------------------------------------------
            */

            $profile = PlayerProfile::query()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    ...$data,
                    'declares_free_agent' => $data['contract_status'] === 'free',
                    'verification_status' => 'verifie',
                    'is_premium' => false,
                    'visibility_score' => 0,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Création des vidéos
            |--------------------------------------------------------------------------
            */

            foreach ($videos as $index => $title) {
                PlayerVideo::query()->updateOrCreate(
                    [
                        'player_profile_id' => $profile->id,
                        'title' => $title,
                    ],
                    [
                        's3_key' => 'demo/player-videos/' . $profile->id . '/' . ($index + 1),
                        'is_highlight' => $index === 0,
                        'order' => $index,
                    ]
                );
            }
        }
    }
}