<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
      use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'amount',
        'payment_method',
        'status',
        'payment_date',
        'user_id',
        'event_id'
    ];

    protected static $allowIncluded = [
        'user',
        'event'
    ];

    protected static $allowFilter = [
        'id',
        'amount',
        'payment_method',
        'status',
        'payment_date',
        'user_id',
        'event_id',
        'created_at',
        'updated_at'
    ];

    public function events(){
        return $this->belongsTo(Event::class);//tenia hasMany
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
