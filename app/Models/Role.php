<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'is_custom',
    ];

    public function bureauMembers()
    {
        return $this->hasMany(BureauMember::class);
    }
}
