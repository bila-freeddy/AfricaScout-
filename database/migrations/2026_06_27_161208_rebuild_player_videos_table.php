<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('player_videos', function (Blueprint $table) {
            // Supprimer les anciennes FK
            $table->dropForeign(['player_id']);
            $table->dropForeign(['uploaded_by_user_id']);

            // Supprimer les anciennes colonnes
            $table->dropIndex('player_videos_player_id_created_at_index');
            $table->dropColumn(['player_id', 'uploaded_by_user_id', 'video_url']);

            // Ajouter les nouvelles colonnes
            $table->foreignId('player_profile_id')
                  ->constrained('player_profiles')->cascadeOnDelete()->after('id');
            $table->string('s3_key')->after('title');
            $table->string('thumbnail_url')->nullable()->after('s3_key');
            $table->unsignedInteger('duration_seconds')->nullable()->after('thumbnail_url');
            $table->unsignedInteger('views_count')->default(0)->after('duration_seconds');
            $table->boolean('is_highlight')->default(false)->after('views_count');
            $table->unsignedSmallInteger('order')->default(0)->after('is_highlight');
        });
    }

    public function down(): void
    {
        Schema::table('player_videos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('player_profile_id');
            $table->dropColumn(['s3_key','thumbnail_url','duration_seconds',
                                'views_count','is_highlight','order']);
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('uploaded_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('video_url');
        });
    }
};