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
        'activityEvents',     
        'services',          
        'payment',            
        'eventuser',         
        'user',              
        'securityevent',      
        'feedback',
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

    public function activityEvents()
    {
        return $this->hasMany(ActivityEvent::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function eventuser()
    {
        return $this->belongsTo(EventUser::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function securityevent()
    {
        return $this->belongsTo(SecurityEvent::class);
    }
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

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
