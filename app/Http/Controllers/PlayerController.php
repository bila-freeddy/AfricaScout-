<?php
namespace App\Http\Controllers;

use App\Models\Player;
use Inertia\Inertia;
use Inertia\Response;

class PlayerController extends Controller
{
    public function index(): Response
    {
        $players = Player::query()->orderBy('name')->get()
            ->map(fn (Player $player) => $this->formatForList($player))->values();
        return Inertia::render('RecruiterDashboard', ['players' => $players]);
    }

    public function indexRecruiterHome(): Response
    {
        $players = Player::query()->orderBy('name')->get()
            ->map(fn (Player $player) => $this->formatForList($player))->values();
        return Inertia::render('RecruiterHome', ['players' => $players]);
    }

    public function indexClub(): Response
    {
        $players = Player::query()->orderBy('name')->get()
            ->map(fn (Player $player) => $this->formatForList($player))->values();
        return Inertia::render('ClubDashboard', ['players' => $players]);
    }

    public function indexClubHome(): Response
    {
        $players = Player::query()->orderBy('name')->get()
            ->map(fn (Player $player) => $this->formatForList($player))->values();
        return Inertia::render('ClubHome', ['players' => $players]);
    }

    public function show(int $id): Response
    {
        $player = Player::query()->findOrFail($id);
        return Inertia::render('Player', ['player' => $this->formatForDetail($player)]);
    }

    private function formatForList(Player $player): array
    {
        return [
            'id' => $player->id, 'name' => $player->name,
            'initials' => $player->initials, 'photo' => $player->photo,
            'status' => $player->status, 'nationality' => $player->nationality,
            'age' => $player->age, 'position' => $player->position,
            'foot' => $player->foot, 'available' => $player->available,
            'stats' => [
                'matchs' => $player->matchs, 'buts' => $player->buts,
                'passes' => $player->passes, 'jaunes' => $player->jaunes,
                'rouges' => $player->rouges,
            ],
        ];
    }

    private function formatForDetail(Player $player): array
    {
        return [
            ...$this->formatForList($player),
            'height' => $player->height, 'weight' => $player->weight,
            'club' => $player->club, 'agent' => $player->agent,
            'videos' => $player->videos()->latest()->get()
                ->map(fn ($v) => ['title' => $v->title, 'desc' => $v->url])
                ->values()->all(),
        ];
    }
}
