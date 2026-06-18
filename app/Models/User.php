<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'role',
        'statut',
        'photo',
        'adresse',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    public function actualites()
    {
        return $this->hasMany(Actualite::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'responsable_id');
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeModerateur($query)
    {
        return $query->where('role', 'moderateur');
    }

    public function scopeMembre($query)
    {
        return $query->where('role', 'membre');
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', 'inactif');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerateur(): bool
    {
        return $this->role === 'moderateur';
    }

    public function isMembre(): bool
    {
        return $this->role === 'membre';
    }

    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
    }
}
