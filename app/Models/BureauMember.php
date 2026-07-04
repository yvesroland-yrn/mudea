<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BureauMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_id',
        'prenom',
        'nom',
        'mandat',
        'photo',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
    }

    public function getRoleNameAttribute(): string
    {
        return $this->role->nom ?? 'N/A';
    }
}
