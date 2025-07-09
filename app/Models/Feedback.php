<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Feedback extends Model
{
      use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'event_id',
        'user_id',
        'comment',
        'rating',
        'date'
    ];

    protected static $allowIncluded = [
        'event',
        'user'
    ];

    protected static $allowFilter = [
        'id',
        'event_id',
        'user_id',
        'comment',
        'rating',
        'date',
        'created_at',
        'updated_at'
    ];

    
    // Scope para cargar relaciones
    public function scopeIncluded(Builder $query): Builder
    {
        if (empty(request('included'))) {
            return $query;
        }

        $relations = explode(',', request('included'));
        $allowed = collect(self::$allowIncluded);

        $validRelations = array_filter($relations, fn($rel) => $allowed->contains($rel));
        return $query->with($validRelations);
    }

    // Scope para aplicar filtros
    public function scopeFilter(Builder $query): Builder
    {
        if (empty(request('filter'))) {
            return $query;
        }

        $filters = request('filter');
        $allowed = collect(self::$allowFilter);

        foreach ($filters as $field => $value) {
            if ($allowed->contains($field)) {
                // Manejo especial para rating (búsqueda exacta)
                if ($field === 'rating') {
                    $query->where($field, $value);
                } else {
                    $query->where($field, 'LIKE', "%$value%");
                }
            }
        }

        return $query;
    }
}
