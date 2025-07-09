<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'content',
        'sent_at',
        'sender_id',
        'receiver_id'
    ];

    protected static $allowIncluded = [
        'sender',
        'receiver'
    ];

    protected static $allowFilter = [
        'id',
        'content',
        'sent_at',
        'sender_id',
        'receiver_id',
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
                $query->where($field, 'LIKE', "%$value%");
            }
        }

        return $query;
    }
    
}
