<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SecurityEvent extends Model
{
      use HasFactory;

    protected $table = 'security_events';

    protected $fillable = [
        'event_id',
        'access_code',
        'incident',
        'date',
    ];

    protected static $allowIncluded = [
        'events',
    ];

    protected static $allowFilter = [
        'id',
        'event_id',
        'access_code',
        'incident',
        'date',
    ];

    public function events(){
        return $this->hasMany(Event::class);
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
