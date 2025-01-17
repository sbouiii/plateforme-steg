<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'devis_id',
        'date_signature',
        'document',
    ];

    /**
     * Relation : Un contrat appartient à un devis.
     */
    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
