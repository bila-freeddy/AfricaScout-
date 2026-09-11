<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlayerProfileController;
use App\Http\Controllers\Api\PlayerVideoController;
use App\Http\Controllers\Api\PlayerAssignmentController;
use App\Http\Controllers\Api\ContactRequestController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Auth publique
    |--------------------------------------------------------------------------
    */

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Routes protégées
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        /*
        |--------------------------------------------------------------------------
        | Profil joueur
        |--------------------------------------------------------------------------
        */

        Route::get('/players/me', [PlayerProfileController::class, 'me']);
        Route::put('/players/me', [PlayerProfileController::class, 'updateMe']);
        Route::post('/players/me/photo', [PlayerProfileController::class, 'uploadPhoto']);

        Route::post('/players', [PlayerProfileController::class, 'store']);
        Route::put('/players/{playerProfile}', [PlayerProfileController::class, 'update']);
        Route::delete('/players/{playerProfile}', [PlayerProfileController::class, 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Assignation club / agent (Ticket 9)
        |--------------------------------------------------------------------------
        */

        Route::post('/players/{playerProfile}/assign-club', [PlayerAssignmentController::class, 'assignClub']);
        Route::post('/players/{playerProfile}/assign-agent', [PlayerAssignmentController::class, 'assignAgent']);
        Route::post('/players/me/confirm-agent', [PlayerAssignmentController::class, 'confirmAgent']);
        Route::post('/players/me/reject-agent', [PlayerAssignmentController::class, 'rejectAgent']);

        /*
        |--------------------------------------------------------------------------
        | Vidéos du joueur connecté
        |--------------------------------------------------------------------------
        */

        Route::get('/players/me/videos', [PlayerVideoController::class, 'index']);
        Route::post('/players/me/videos', [PlayerVideoController::class, 'store']);
        Route::delete('/players/me/videos/{playerVideo}', [PlayerVideoController::class, 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Demandes de contact (Ticket 4bis)
        |--------------------------------------------------------------------------
        */

        Route::get('/contact-requests', [ContactRequestController::class, 'index']);
        Route::post('/contact-requests', [ContactRequestController::class, 'store']);
        Route::patch('/contact-requests/{contactRequest}/status', [ContactRequestController::class, 'updateStatus']);

        /*
        |--------------------------------------------------------------------------
        | Messagerie
        |--------------------------------------------------------------------------
        */

        Route::get('/conversations', [ConversationController::class, 'index']);
        Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);
        Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);
        Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store']);
    });

    /*
    |--------------------------------------------------------------------------
    | Lecture publique
    |--------------------------------------------------------------------------
    */

    Route::get('/players', [PlayerProfileController::class, 'index']);
    Route::get('/players/{playerProfile}', [PlayerProfileController::class, 'show']);

    // Lecture publique d'une vidéo
    Route::get('/players/videos/{playerVideo}', [PlayerVideoController::class, 'show']);
});