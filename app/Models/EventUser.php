<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EventUser extends Model
{
    
    use HasFactory;

    protected $table = 'event_user';

    protected $fillable = [
        'event_id',
        'user_id'
    ];

    protected static $allowIncluded = [
        'events',
        'user'
    ];

    protected static $allowFilter = [
        'id',
        'event_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function events(){
        return $this->hasMany(Event::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
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
                $query->where($field, 'LIKE', "%$value%");
            }
        }

        return $query;
    }
}
