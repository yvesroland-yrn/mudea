<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'meta_title',
        'meta_description',
        'is_published',
        'is_home',
        'ordre',
        'user_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_home' => 'boolean',
        'ordre' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    public function scopeHome($query)
    {
        return $query->where('is_home', true);
    }

    public function scopeOrderByOrdre($query)
    {
        return $query->orderBy('ordre');
    }
}
