<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company')->nullable();
            $table->string('country');
            $table->enum('type', ['Agent', 'Club', 'Recruteur indépendant'])->default('Recruteur indépendant');
            $table->string('license_number')->nullable();
            $table->boolean('verified')->default(false);
            $table->enum('plan', ['starter', 'pro', 'elite'])->default('starter');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('recruiters'); }
};