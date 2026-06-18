<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evenement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'date',
        'lieu',
        'heure_debut',
        'heure_fin',
        'image',
        'statut',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAVenir($query)
    {
        return $query->where('statut', 'a_venir')->where('date', '>=', now());
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeTermine($query)
    {
        return $query->where('statut', 'termine');
    }

    public function scopeAnnule($query)
    {
        return $query->where('statut', 'annule');
    }

    public function scopeFuturs($query)
    {
        return $query->where('date', '>=', now());
    }

    public function scopePasses($query)
    {
        return $query->where('date', '<', now());
    }
}
