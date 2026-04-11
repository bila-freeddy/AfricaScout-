<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('uploaded_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('video_url');
            $table->timestamps();

            $table->index(['player_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_videos');
    }
};
