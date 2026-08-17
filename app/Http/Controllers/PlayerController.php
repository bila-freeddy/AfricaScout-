<?php

namespace App\Http\Controllers;

use App\Models\PlayerProfile;
use Inertia\Inertia;
use Inertia\Response;

class PlayerController extends Controller
{
    /**
     * --------------------------------------------------------------------------
     * Récupère la liste des joueurs
     * --------------------------------------------------------------------------
     *
     * Toutes les pages (Dashboard recruteur, Dashboard club, Home...)
     * utilisent exactement les mêmes données.
     *
     * Afin d'éviter de répéter la même requête dans plusieurs méthodes,
     * toute la logique est centralisée ici.
     *
     * Le with() permet de charger les relations dès la première requête
     * afin d'éviter le problème des requêtes N+1.
     */
    private function getPlayers()
    {
        return PlayerProfile::query()

            // Chargement anticipé des relations
            ->with([
                'club',
                'agent',
                'videos'
            ])

            // Tri alphabétique
            ->orderBy('last_name')
            ->orderBy('first_name')

            ->get()

            // Format adapté au Frontend
            ->map(fn(PlayerProfile $player) => $this->formatForList($player))

            ->values();
    }

    /**
     * Dashboard principal du recruteur.
     */
    public function index(): Response
    {
        return Inertia::render('RecruiterDashboard', [
            'players' => $this->getPlayers(),
        ]);
    }

    /**
     * Accueil recruteur.
     */
    public function indexRecruiterHome(): Response
    {
        return Inertia::render('RecruiterHome', [
            'players' => $this->getPlayers(),
        ]);
    }

    /**
     * Dashboard principal du club.
     */
    public function indexClub(): Response
    {
        return Inertia::render('ClubDashboard', [
            'players' => $this->getPlayers(),
        ]);
    }

    /**
     * Accueil du club.
     */
    public function indexClubHome(): Response
    {
        return Inertia::render('ClubHome', [
            'players' => $this->getPlayers(),
        ]);
    }

    /**
     * --------------------------------------------------------------------------
     * Affiche le profil détaillé d'un joueur
     * --------------------------------------------------------------------------
     *
     * Charge également les vidéos, le club et l'agent.
     */
    public function show(int $id): Response
    {
        $player = PlayerProfile::query()

            ->with([
                'club',
                'agent',
                'videos'
            ])

            ->findOrFail($id);

        return Inertia::render('Player', [
            'player' => $this->formatForDetail($player),
        ]);
    }

    /**
     * --------------------------------------------------------------------------
     * Formate les données destinées aux listes
     * --------------------------------------------------------------------------
     *
     * Cette méthode construit un objet simple que React/Inertia pourra
     * afficher facilement.
     *
     * Toutes les pages affichant une liste de joueurs utilisent ce format.
     */
    private function formatForList(PlayerProfile $player): array
    {
        return [

            // Identifiant
            'id' => $player->id,

            // Informations générales
            'name' => $player->full_name,
            'initials' => $player->initials,
            'photo' => $player->photo_url,

            // Situation actuelle
            'status' => $player->contract_status,
            'verification_status' => $player->verification_status,
            'available' => $player->available,
            'premium' => $player->is_premium,

            // Informations personnelles
            'nationality' => $player->nationality,
            'age' => $player->age,

            // Informations sportives
            'position' => $player->position,
            'foot' => $player->strong_foot,

            // Statistiques
            'stats' => [

                'matchs' => $player->matches_played,
                'buts' => $player->goals,
                'passes' => $player->assists,
                'jaunes' => $player->yellow_cards,
                'rouges' => $player->red_cards,

            ],
        ];
    }

    /**
     * --------------------------------------------------------------------------
     * Formate le profil complet d'un joueur
     * --------------------------------------------------------------------------
     *
     * Cette méthode réutilise d'abord le format de la liste,
     * puis ajoute les informations détaillées.
     *
     * Cela évite de dupliquer le code.
     */
    private function formatForDetail(PlayerProfile $player): array
    {
        return [

            // Toutes les informations de base
            ...$this->formatForList($player),

            // Présentation
            'bio' => $player->bio,

            // Caractéristiques physiques
            'height' => $player->height_cm,
            'weight' => $player->weight_kg,

            // Relations
            'club' => $player->club,
            'agent' => $player->agent,

            // Contrat
            'contract_status' => $player->contract_status,
            'contract_end_date' => $player->contract_end_date,

            // Agent libre
            'declares_free_agent' => $player->declares_free_agent,

            // Vidéos
            'videos' => $player->videos

                ->sortBy('order')

                ->values()

                ->map(function ($video) {

                    return [

                        'id' => $video->id,

                        'title' => $video->title,

                        'thumbnail' => $video->thumbnail_url,

                        // Clé du stockage S3/MinIO
                        's3_key' => $video->s3_key,

                        'duration_seconds' => $video->duration_seconds,

                        'views_count' => $video->views_count,

                        'is_highlight' => $video->is_highlight,

                        'order' => $video->order,

                    ];

                }),

        ];
    }
}