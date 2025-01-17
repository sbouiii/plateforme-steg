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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devis_id')->constrained('devis')->onDelete('cascade'); // Lien avec le devis accepté
            $table->date('date_signature'); // Date de signature
            $table->string('document')->nullable(); // Fichier du contrat (chemin vers fichier PDF ou autre)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
