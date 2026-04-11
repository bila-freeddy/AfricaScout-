<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubPlayerVideoController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ─── Pages publiques ───────────────────────────────────────────────
Route::get('/', fn() => Inertia::render('Home'));

// ─── Authentification ──────────────────────────────────────────────
Route::get('/Login',  [AuthController::class, 'showLogin'])->name('Login');
Route::post('/Login', [AuthController::class, 'Login'])->name('Login.submit');
Route::post('/Logout', [AuthController::class, 'logout'])->name('logout');

// ─── Inscription ───────────────────────────────────────────────────
Route::get('/inscription',        [RegistrationController::class, 'chooseRole'])->name('register.choose');
Route::get('/inscription/joueur', [RegistrationController::class, 'showPlayerForm'])->name('register.player.form');
Route::post('/inscription/joueur',[RegistrationController::class, 'registerPlayer'])->name('register.player.submit');
Route::get('/inscription/agent',  [RegistrationController::class, 'showAgentForm'])->name('register.agent.form');
Route::post('/inscription/agent', [RegistrationController::class, 'registerAgent'])->name('register.agent.submit');
Route::get('/inscription/club',   [RegistrationController::class, 'showClubForm'])->name('register.club.form');
Route::post('/inscription/club',  [RegistrationController::class, 'registerClub'])->name('register.club.submit');

// ─── Profils joueurs publics ───────────────────────────────────────
Route::get('/player/signup',    fn() => Inertia::render('PlayerSignup'));
Route::get('/player/dashboard', fn() => Inertia::render('PlayerDashboard'));
Route::get('/player/{id}',      [PlayerController::class, 'show']);

// ─── Portail ──────────────────────────────────────────────────────
Route::get('/espace', [PortalController::class, 'redirectToRoleSpace'])
    ->middleware('auth')->name('portal.redirect');

// ─── Dashboard Joueur ─────────────────────────────────────────────
Route::get('/dashboard/joueur', [PortalController::class, 'joueurDashboard'])
    ->middleware(['auth', 'role:joueur'])->name('joueur.dashboard');

// ─── Dashboard Agent ──────────────────────────────────────────────
Route::get('/dashboard/agent', [PortalController::class, 'agentDashboard'])
    ->middleware(['auth', 'role:agent_recruteur'])->name('agent.dashboard');
Route::get('/recruiter/dashboard', [PlayerController::class, 'index'])
    ->middleware(['auth', 'role:agent_recruteur']);
Route::get('/recruiter/home', [PlayerController::class, 'indexRecruiterHome'])
    ->middleware(['auth', 'role:agent_recruteur']);
Route::get('/recruiter/signup', fn() => Inertia::render('RecruiterSignup'));

// ─── Dashboard Club ───────────────────────────────────────────────
Route::get('/dashboard/club', [PortalController::class, 'clubDashboard'])
    ->middleware(['auth', 'role:club'])->name('club.dashboard');
Route::get('/club/dashboard', [PlayerController::class, 'indexClub'])
    ->middleware(['auth', 'role:club']);
Route::get('/club/home', [PlayerController::class, 'indexClubHome'])
    ->middleware(['auth', 'role:club']);
Route::get('/club/signup', fn() => Inertia::render('ClubSignup'));

// ─── Vidéos ───────────────────────────────────────────────────────
Route::post('/players/{player}/videos', [ClubPlayerVideoController::class, 'store'])
    ->middleware('auth')->name('players.videos.store');

// ─── Contact Requests ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/contact-requests', [ContactRequestController::class, 'store'])
        ->name('contact-requests.store');
    Route::get('/contact-requests', [ContactRequestController::class, 'index'])
        ->name('contact-requests.index');
    Route::patch('/contact-requests/{contactRequest}/status', [ContactRequestController::class, 'updateStatus'])
        ->name('contact-requests.update-status');
});