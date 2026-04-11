<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('players', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('initials', 5);
        $table->string('photo')->nullable();
        $table->enum('status', ['Libre', 'Sous contrat', 'Avec agent'])->default('Libre');
        $table->string('nationality');
        $table->integer('age');
        $table->string('position');
        $table->enum('foot', ['Droit', 'Gauche', 'Les deux'])->default('Droit');
        $table->integer('height')->nullable();
        $table->integer('weight')->nullable();
        $table->boolean('available')->default(true);
        $table->integer('matchs')->default(0);
        $table->integer('buts')->default(0);
        $table->integer('passes')->default(0);
        $table->integer('jaunes')->default(0);
        $table->integer('rouges')->default(0);
        $table->string('club')->nullable();
        $table->string('agent')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
