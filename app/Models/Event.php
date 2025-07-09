<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Event extends Model
{
     use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'status'
    ];

    protected static $allowIncluded = [
        'organizer'
    ];

    protected static $allowFilter = [
        'id',
        'organizer_id',
        'title',
        'start_date',
        'end_date',
        'location',
        'status',
        'created_at',
        'updated_at'
    ];

   

    // Scope para cargar relaciones
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

    // Scope para aplicar filtros
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
