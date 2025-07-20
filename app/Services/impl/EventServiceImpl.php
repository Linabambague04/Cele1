<?php

namespace App\Services\impl;

use App\Models\Event;
use App\Services\EventService;

class EventServiceImpl implements EventService
{
    public function all(){
        return Event::included()->filter()->get();
    }

    public function show($id){
        return Event::with([
        'services',
        'activityEvents',
        'payment',
        'payment',
        'eventuser',
        'user',
        'securityevent',
        'feedback',
        ])->findOrFail($id);
    }

    public function create(array $data){
        return Event::create($data);
    }

    public function update($id, array $data){
        $event = Event::find($id);
        if(!$event){
            return null;
        }
        
        $event->update($data);
        return $event;
    }

    public function delete($id){
        $event = Event::find($id);
        if(!$event){
            return false;
        }

        return $event->delete;
    }
}
