<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'objet',
        'message',
        'statut',
        'lu_at',
        'traite_at',
    ];

    protected $casts = [
        'lu_at' => 'datetime',
        'traite_at' => 'datetime',
    ];

    public function scopeNouveau($query)
    {
        return $query->where('statut', 'nouveau');
    }

    public function scopeLu($query)
    {
        return $query->where('statut', 'lu');
    }

    public function scopeTraite($query)
    {
        return $query->where('statut', 'traite');
    }

    public function scopeArchive($query)
    {
        return $query->where('statut', 'archive');
    }

    public function scopeNonLu($query)
    {
        return $query->whereNull('lu_at');
    }

    public function markAsLu()
    {
        $this->update([
            'statut' => 'lu',
            'lu_at' => now(),
        ]);
    }

    public function markAsTraite()
    {
        $this->update([
            'statut' => 'traite',
            'traite_at' => now(),
        ]);
    }
}
