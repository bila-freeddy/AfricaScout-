<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration de contact_requests vers PlayerProfile.
     *
     * L'ancien système utilisait :
     *
     * contact_requests.player_id -> players.id
     *
     * Le nouveau système utilise :
     *
     * contact_requests.player_profile_id -> player_profiles.id
     */
    public function up(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            // Suppression de l'ancienne clé étrangère.
            $table->dropForeign(['player_id']);

            // Suppression de l'ancienne colonne.
            $table->dropColumn('player_id');

            // Nouvelle référence vers PlayerProfile.
            $table->foreignId('player_profile_id')
                ->after('id')
                ->constrained('player_profiles')
                ->cascadeOnDelete();
        });
    }

    /**
     * Retour arrière de la migration.
     */
    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            // Suppression de la nouvelle relation.
            $table->dropForeign(['player_profile_id']);
            $table->dropColumn('player_profile_id');

            // Restauration de l'ancienne colonne.
            $table->foreignId('player_id')
                ->after('id')
                ->constrained('players')
                ->cascadeOnDelete();
        });
    }
};