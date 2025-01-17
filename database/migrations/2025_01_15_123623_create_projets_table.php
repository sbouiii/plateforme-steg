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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre du projet
            $table->text('description'); // Description du projet
            $table->string('lieu')->nullable(); // Localisation du projet
            $table->decimal('budget_estime', 15, 2); // Budget estimé
            $table->date('date_debut'); // Date de début du projet
            $table->date('date_fin')->nullable(); // Date de fin prévue
            $table->enum('status', ['en_attente', 'en_cours', 'termine', 'annule'])
                ->default('en_attente'); // Statut du projet
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
