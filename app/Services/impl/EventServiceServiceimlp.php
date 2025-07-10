<?php

namespace App\Services\impl;

use App\Models\EventService;
use App\Services\EventServiceService;

class EventServiceServiceimlp implements EventServiceService
{
    public function all(){
        return EventService:: include()->filter()->get();
    }

    public function show($id){
        return EventService::with(['activityEvents',
        'securityEvent',
        'payments',
        'feedback'])->find($id);
    }

    public function create(array $data){
        return EventService::create($data);
    }

    public function update($id, array $data){
        $event = EventService::find($id);
        if(!$event){
            return null;
        }
        
        $event->update($data);
        return $event;
    }

    public function delete($id){
        $event = EventService::find($id);
        if(!$event){
            return false;
        }

        return $event->delete;
    }
}
