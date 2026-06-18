<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'statut',
        'secteur',
        'budget',
        'avancement',
        'date_debut',
        'date_fin',
        'media',
        'featured',
        'responsable_id',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'avancement' => 'integer',
        'featured' => 'boolean',
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en-cours');
    }

    public function scopeRealise($query)
    {
        return $query->where('statut', 'realise');
    }

    public function scopeFutur($query)
    {
        return $query->where('statut', 'futur');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeBySecteur($query, $secteur)
    {
        return $query->where('secteur', $secteur);
    }
}
