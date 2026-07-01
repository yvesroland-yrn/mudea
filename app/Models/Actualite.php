<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actualite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'slug',
        'categorie',
        'statut',
        'auteur',
        'date_publication',
        'resume',
        'contenu',
        'image',
        'tags',
        'vues',
        'epingle',
        'user_id',
    ];

    protected $casts = [
        'tags' => 'array',
        'date_publication' => 'date',
        'epingle' => 'boolean',
        'vues' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublie($query)
    {
        return $query->where('statut', 'publie');
    }

    public function scopeBrouillon($query)
    {
        return $query->where('statut', 'brouillon');
    }

    public function scopeArchive($query)
    {
        return $query->where('statut', 'archive');
    }

    public function scopeEpingle($query)
    {
        return $query->where('epingle', true);
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}
