<?php

namespace App\Services\impl;

use App\Models\ResourceEvent;
use App\Services\EventResourcesService;

class EventResourcesServiceImpl implements EventResourcesService
{
     public function all()
    {
        return ResourceEvent::included()->filter()->get();
    }

    public function show ($id)
    {
        return ResourceEvent::with(['sender', 'receiver'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return ResourceEvent::create($data);
    }
    public function update($id, array $data)
    {
        $message = ResourceEvent::find($id);
        if (!$message) {
            return null;
        }
        $message->update($data);
        return $message;
    }

    public function delete($id)
    {
        $message = ResourceEvent::find($id);
        if (!$message) {
            return false;
        }
        return $message->delete();
    }
}
