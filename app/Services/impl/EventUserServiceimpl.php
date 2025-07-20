<?php

namespace App\Services\impl;

use App\Models\EventUser;
use App\Services\EventUserService;

class EventUserServiceimpl implements EventUserService
{
    public function all()
    {
        return EventUser::included()->filter()->get();
    }

    public function show($id) {
        return EventUser::with(['events', 'user'])->findOrFail($id);
    }

    public function create(array $data){
        return EventUser::create($data);
    }
    public function update($id, array $data){
        $eventUser = EventUser::find($id);
        if(!$eventUser) {
            return null;
        }
        $eventUser->update($data);
        return $eventUser;
    }

    public function delete($id){
        $eventUser = EventUser::find($id);
        if(!$eventUser){
            return false;
        }
        return $eventUser->delete();
    }
}
