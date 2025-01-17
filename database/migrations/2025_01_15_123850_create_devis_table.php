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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained('projets')->onDelete('cascade'); // Lien avec projet
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade'); // Lien avec le fournisseur
            $table->decimal('montant', 15, 2); // Montant du devis
            $table->text('details')->nullable(); // Détails sur le devis
            $table->integer('delai'); // Délai d'exécution (jours)
            $table->enum('status', ['en_attente', 'accepte', 'rejete'])->default('en_attente'); // Statut du devis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
