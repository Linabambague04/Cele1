<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'registration_date',
        'status',
    ];
    protected static $allowIncluded = [
        'userServices',
        'eventServices',
        'supports',
    ];
    protected static $allowFilter = [
        'id',
        'name',
        'email',
        'registration_date',
        'status',
    ];

    // Scope para incluir relaciones dinámicamente
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

    // Scope para aplicar filtros por campos permitidos
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
