<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Supplier extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number',
    ];

    protected $hidden = [
        'password',
    ];

    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}
