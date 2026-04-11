<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requester_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('recipient_user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['en_attente', 'acceptee', 'refusee', 'annulee'])->default('en_attente');
            $table->text('message_initial')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->index(['recipient_user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
