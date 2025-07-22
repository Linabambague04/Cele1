<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Service extends Model
{
     use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    protected static $allowIncluded = [
        'ServiceUser',
        'EventService'
    ];

    protected static $allowFilter = [
        'id',
        'nombre',
        'descripcion',
    ];
    
    public function events(){
        return $this->belongsToMany(Event::class);
    }

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
