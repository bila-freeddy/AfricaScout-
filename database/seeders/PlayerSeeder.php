<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Video;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            [
                'name'        => 'Amadou Konaté',
                'initials'    => 'AK',
                'status'      => 'Libre',
                'nationality' => 'Mali',
                'age'         => 23,
                'position'    => 'Milieu défensif',
                'foot'        => 'Droit',
                'height'      => 185,
                'weight'      => 78,
                'available'   => true,
                'matchs'      => 32,
                'buts'        => 4,
                'passes'      => 8,
                'jaunes'      => 6,
                'rouges'      => 0,
                'videos' => [
                    ['title' => 'Highlights Saison 2025/26', 'url' => '#'],
                    ['title' => 'Compétences défensives',   'url' => '#'],
                ],
            ],
            [
                'name'        => 'Kwame Mensah',
                'initials'    => 'KM',
                'status'      => 'Sous contrat',
                'nationality' => 'Ghana',
                'age'         => 21,
                'position'    => 'Attaquant',
                'foot'        => 'Gauche',
                'height'      => 178,
                'weight'      => 72,
                'available'   => false,
                'matchs'      => 28,
                'buts'        => 15,
                'passes'      => 7,
                'jaunes'      => 3,
                'rouges'      => 0,
                'videos' => [
                    ['title' => 'Top Buts 2025', 'url' => '#'],
                ],
            ],
            [
                'name'        => 'Youssef Benali',
                'initials'    => 'YB',
                'status'      => 'Avec agent',
                'nationality' => 'Maroc',
                'age'         => 25,
                'position'    => 'Gardien de but',
                'foot'        => 'Droit',
                'height'      => 192,
                'weight'      => 85,
                'available'   => true,
                'matchs'      => 30,
                'buts'        => 0,
                'passes'      => 1,
                'jaunes'      => 2,
                'rouges'      => 0,
                'videos' => [
                    ['title' => 'Arrêts Saison 2025', 'url' => '#'],
                ],
            ],
            [
                'name'        => 'Emmanuel Okafor',
                'initials'    => 'EO',
                'status'      => 'Libre',
                'nationality' => 'Nigeria',
                'age'         => 24,
                'position'    => 'Défenseur central',
                'foot'        => 'Droit',
                'height'      => 188,
                'weight'      => 82,
                'available'   => true,
                'matchs'      => 26,
                'buts'        => 2,
                'passes'      => 3,
                'jaunes'      => 4,
                'rouges'      => 1,
                'videos' => [
                    ['title' => 'Highlights Défensifs', 'url' => '#'],
                ],
            ],
            [
                'name'        => 'Abdoulaye Diallo',
                'initials'    => 'AD',
                'status'      => 'Sous contrat',
                'nationality' => 'Sénégal',
                'age'         => 20,
                'position'    => 'Ailier droit',
                'foot'        => 'Les deux',
                'height'      => 174,
                'weight'      => 68,
                'available'   => false,
                'matchs'      => 24,
                'buts'        => 9,
                'passes'      => 12,
                'jaunes'      => 2,
                'rouges'      => 0,
                'videos' => [
                    ['title' => 'Dribbles et Vitesse', 'url' => '#'],
                ],
            ],
            [
                'name'        => 'Kofi Asante',
                'initials'    => 'KA',
                'status'      => 'Avec agent',
                'nationality' => "Côte d'Ivoire",
                'age'         => 22,
                'position'    => 'Milieu offensif',
                'foot'        => 'Gauche',
                'height'      => 176,
                'weight'      => 70,
                'available'   => true,
                'matchs'      => 29,
                'buts'        => 11,
                'passes'      => 14,
                'jaunes'      => 3,
                'rouges'      => 0,
                'videos' => [
                    ['title' => 'Vision de jeu 2025', 'url' => '#'],
                ],
            ],
        ];

        foreach ($players as $data) {
            $videos = $data['videos'];
            unset($data['videos']);

            $player = Player::create($data);

            foreach ($videos as $video) {
                Video::create([
                    'player_id' => $player->id,
                    'title'     => $video['title'],
                    'url'       => $video['url'],
                ]);
            }
        }
    }
}