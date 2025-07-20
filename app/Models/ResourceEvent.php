<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResourceEvent extends Model
{
    use HasFactory;

    protected $table = 'event_resource';

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'event_id'
    ];

    protected static $allowIncluded = [
        'event'
    ];

    protected static $allowFilter = [
        'id',
        'name',
        'type',
        'quantity',
        'event_id',
        'created_at',
        'updated_at'
    ];

    
    // Scope para cargar relaciones (MANTENIDO SIN CAMBIOS)
    public function scopeIncluded(Builder $query)
    {
        if (empty(request('included'))) {
            return $query;
        }

        $relations = explode(',', request('included'));
        $allowed = collect(self::$allowIncluded);

        $validRelations = array_filter($relations, fn($rel) => $allowed->contains($rel));
        return $query->with($validRelations);
    }

    // Scope para aplicar filtros (MANTENIDO SIN CAMBIOS)
    public function scopeFilter(Builder $query)
    {
        if (empty(request('filter'))) {
            return $query;
        }

        $filters = request('filter');
        $allowed = collect(self::$allowFilter);

        foreach ($filters as $field => $value) {
            if ($allowed->contains($field)) {
                $query->where($field, 'LIKE', "%$value%");
            }
        }

        return $query;
    }
}
