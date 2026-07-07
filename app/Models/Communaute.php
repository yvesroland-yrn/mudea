<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Communaute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'categorie',
        'statut',
        'description',
        'image',
    ];

    public function scopePublie($query)
    {
        return $query->where('statut', 'publie');
    }

    public function scopeBrouillon($query)
    {
        return $query->where('statut', 'brouillon');
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}
