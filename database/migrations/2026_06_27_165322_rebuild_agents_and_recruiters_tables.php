<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Enrichir agents (table vide donc pas de risque)
        Schema::table('agents', function (Blueprint $table) {
            $table->foreignId('user_id')
                  ->constrained()->cascadeOnDelete()->after('id');
            $table->string('company')->nullable()->after('user_id');
            $table->string('country')->nullable()->after('company');
            $table->string('license_number')->nullable()->after('country');
            $table->boolean('verified')->default(false)->after('license_number');
            $table->enum('plan', ['none','starter','pro','elite'])
                  ->default('none')->after('verified');
            $table->string('verification_status')->default('en_attente')->after('plan');
        });

        // Aligner recruiters avec agents
        Schema::table('recruiters', function (Blueprint $table) {
            $table->string('verification_status')
                  ->default('en_attente')->after('plan');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['company','country','license_number',
                                'verified','plan','verification_status']);
        });
        Schema::table('recruiters', function (Blueprint $table) {
            $table->dropColumn('verification_status');
        });
    }
};