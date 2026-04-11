<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PortalController extends Controller
{
    public function redirectToRoleSpace(): RedirectResponse
    {
        $currentUser = $this->resolveCurrentUser();

        return match ($currentUser->role) {
            'club' => redirect()->route('club.dashboard'),
            'agent_recruteur' => redirect()->route('agent.dashboard'),
            default => redirect()->route('joueur.dashboard'),
        };
    }

    public function joueurDashboard(): Response
    {
        return Inertia::render('JoueurDashboard');
    }

    public function agentDashboard(): Response
    {
        return Inertia::render('recruiter');
    }

    public function clubDashboard(): Response
    {
        return Inertia::render('ClubDashboard');
    }

    private function resolveCurrentUser(): User
    {
        return User::query()->find(1) ?? User::query()->firstOrFail();
    }
}
