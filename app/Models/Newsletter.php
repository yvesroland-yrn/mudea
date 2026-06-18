<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'nom',
        'prenom',
        'statut',
        'desabonne_at',
        'token',
    ];

    protected $casts = [
        'desabonne_at' => 'datetime',
    ];

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeDesabonne($query)
    {
        return $query->where('statut', 'desabonne');
    }

    public function scopeBounce($query)
    {
        return $query->where('statut', 'bounce');
    }

    public function desabonner()
    {
        $this->update([
            'statut' => 'desabonne',
            'desabonne_at' => now(),
        ]);
    }

    public function reactiver()
    {
        $this->update([
            'statut' => 'actif',
            'desabonne_at' => null,
        ]);
    }
}
