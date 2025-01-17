<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'projet_id',
        'supplier_id',
        'montant',
        'details',
        'status',
        'delai'
    ];

    /**
     * Relation : Un devis appartient à un projet.
     */
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    /**
     * Relation : Un devis appartient à un fournisseur.
     */
    public function fournisseur()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Relation : Un devis peut avoir un contrat (si accepté).
     */
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
}
