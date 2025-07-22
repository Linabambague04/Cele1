<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityEvent extends Model
{
    use HasFactory;
    protected $table = 'activity_events';

    protected $fillable = [
        'activity_id',
        'event_id',
        'activity_type',
        'status',
        'timestamp'
    ];

    protected static $allowIncluded = [
        'event',
    ];

    protected static $allowFilter = [
        'id',
        'activity_id',
        'event_id',
        'activity_type',
        'status',
        'timestamp',
        'created_at',
        'updated_at'
    ];

      public function event(){
        return $this->belongsTo(Event::class);
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
