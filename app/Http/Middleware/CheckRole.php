<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Non connecté → login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Veuillez vous connecter.');
        }

        // Rôle non autorisé → accueil
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}