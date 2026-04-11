<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->foreignId('club_user_id')
                ->nullable()
                ->after('owner_user_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('agent_user_id')
                ->nullable()
                ->after('club_user_id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropConstrainedForeignId('agent_user_id');
            $table->dropConstrainedForeignId('club_user_id');
        });
    }
};
