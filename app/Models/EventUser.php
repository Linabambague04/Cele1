<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //
    public function events(){
        return $this->hasMany(Event::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
