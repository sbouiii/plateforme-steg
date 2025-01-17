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
        Schema::create('suppliers', function (Blueprint $table) {
             $table->id();
            $table->string('full_name');       // Nom complet
            $table->string('email')->unique(); // Email unique
            $table->string('password');        // Mot de passe
            $table->string('phone_number');    // Numéro de téléphone
            $table->timestamps();             // Date de création et modification
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
