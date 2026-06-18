<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    protected $fillable = [
        'cle',
        'valeur',
        'type',
        'groupe',
        'description',
    ];

    protected $casts = [
        'valeur' => 'array',
    ];

    public function scopeByGroupe($query, $groupe)
    {
        return $query->where('groupe', $groupe);
    }

    public static function getValeur($cle, $default = null)
    {
        $param = self::where('cle', $cle)->first();
        if ($param) {
            return $param->type === 'boolean' ? (bool) $param->valeur : $param->valeur;
        }
        return $default;
    }

    public static function setValeur($cle, $valeur)
    {
        return self::updateOrCreate(
            ['cle' => $cle],
            ['valeur' => $valeur]
        );
    }
}
