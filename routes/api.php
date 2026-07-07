<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlayerProfileController;
use App\Http\Controllers\Api\PlayerVideoController;

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
        | Vidéos du joueur connecté
        |--------------------------------------------------------------------------
        */

        Route::get('/players/me/videos', [PlayerVideoController::class, 'index']);
        Route::post('/players/me/videos', [PlayerVideoController::class, 'store']);
        Route::delete('/players/me/videos/{playerVideo}', [PlayerVideoController::class, 'destroy']);
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