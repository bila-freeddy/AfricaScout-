<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->boolean('declares_free_agent')->default(true);
            $table->string('free_agent_proof_type')->nullable();
            $table->string('free_agent_proof_reference')->nullable();
            $table->string('verification_status')->default('en_attente');
            $table->timestamps();
        });

        Schema::create('agent_recruiter_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('organization_name')->nullable();
            $table->string('license_number')->nullable();
            $table->string('identity_document_type')->nullable();
            $table->string('identity_document_reference')->nullable();
            $table->string('verification_status')->default('en_attente');
            $table->timestamps();
        });

        Schema::create('club_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('club_name');
            $table->string('country')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('identity_document_type')->nullable();
            $table->string('identity_document_reference')->nullable();
            $table->string('verification_status')->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_profiles');
        Schema::dropIfExists('agent_recruiter_profiles');
        Schema::dropIfExists('player_profiles');
    }
};
