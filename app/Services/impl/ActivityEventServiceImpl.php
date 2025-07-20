<?php

namespace App\Services\impl;

use App\Models\ActivityEvent;
use App\Services\ActivityEventService;

class ActivityEventServiceImpl implements ActivityEventService
{
    public function all()
    {
        return ActivityEvent::included()->filter()->get();
    }

    public function show($id)
    {
        return ActivityEvent::with('event')->find($id);
    }

    public function create(array $data)
    {
        return ActivityEvent::create($data);
    }

    public function update($id, array $data)
    {
        $activityEvent = ActivityEvent::find($id);
        if(!$activityEvent){
            return null;
        }
        $activityEvent->update($data);
        return $activityEvent;
    }

    public function delete($id)
    {
        $activityEvent = ActivityEvent::find($id);
        if(!$activityEvent){
            return false;
        }
        return $activityEvent->delete();
    }
}
