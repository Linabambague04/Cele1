<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //

    public function activityEvents(){
        return $this->hasMany(ActivityEvent::class);
    }
    public function services(){
        return $this->belongsToMany(Service::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function eventuser(){
        return $this->belongsTo(EventUser::class);
    }
   public function user(){
    return $this->belongsTo(User::class);
   }
   public function securityevent(){
    return $this->belongsTo(SecurityEvent::class);
   }
   public function feedback(){
    return $this->belongsTo(Feedback::class);
   }
 }

