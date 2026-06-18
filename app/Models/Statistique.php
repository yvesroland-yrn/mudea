<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistique extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'cle',
        'valeur',
        'date',
        'metadonnees',
    ];

    protected $casts = [
        'valeur' => 'integer',
        'date' => 'date',
        'metadonnees' => 'array',
    ];

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCle($query, $cle)
    {
        return $query->where('cle', $cle);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }

    public static function incrementer($type, $cle = null, $valeur = 1, $metadonnees = null)
    {
        return self::create([
            'type' => $type,
            'cle' => $cle,
            'valeur' => $valeur,
            'date' => now(),
            'metadonnees' => $metadonnees,
        ]);
    }

    public static function getSomme($type, $cle = null, $start = null, $end = null)
    {
        $query = self::byType($type);
        
        if ($cle) {
            $query = $query->byCle($cle);
        }
        
        if ($start && $end) {
            $query = $query->betweenDates($start, $end);
        }
        
        return $query->sum('valeur');
    }
}
