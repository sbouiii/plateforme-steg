<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'lieu',
        'budget_estime',
        'date_debut',
        'date_fin',
        'status',
    ];

    /**
     * Relation : Un projet peut avoir plusieurs devis.
     */
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}
