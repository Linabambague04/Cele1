<?php

namespace App\Models;
<<<<<<< Updated upstream
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder; 
=======

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Model;

class ActivityEvent extends Model
{
    use HasFactory;

<<<<<<< Updated upstream
    protected $fillable = [
        'activity_type',
        'status',
        'timestamp',
        'event_id'
    ];

    protected static $allowIncluded = [
        'event'//busquedaa consultas
    ];
    protected static $allowFilter =[
        'id',
        'activity_type',
        'status',
        'timestamp',
        'event_id'
    ];

    public function scopeInclude(Builder $query){
        if(empty(request('included'))){
            return $query;
        }
        $relations = explode(',', request('include'));
        $allowed = collect(self::$allowIncluded);
        
        $validRelations = array_filter($relations, fn($rel) => $allowed->contains($rel));
        return $query->with($validRelations);
    }
=======
    protected $table = 'activity_event';

    protected $fillable = [
        'activity_id',
        'event_id',
        'activity_type',
        'status',
        'timestamp'
    ];

    protected static $allowIncluded = [
        'event',
        'activity'
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

>>>>>>> Stashed changes
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
