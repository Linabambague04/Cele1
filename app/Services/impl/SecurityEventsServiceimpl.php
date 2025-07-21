<?php

namespace App\Services\impl;

use App\Models\SecurityEvent;
use App\Services\SecurityEventsService;

class SecurityEventsServiceimpl implements SecurityEventsService
{
    public function all(){
        return SecurityEvent::included()->filter()->get();
    }

    public function show($id){
        return SecurityEvent::with(['event'])->findOrFail($id);
    }

    public function create(array $data){
        return SecurityEvent::create($data);
    }

    public function update($id, array $data)
    {
        $securityEvent = SecurityEvent::find($id);
        if(!$securityEvent){
            return null;
        }
        $securityEvent->update($data);
        return $securityEvent;
    }

    public function delete($id){
        $securityEvent = SecurityEvent::find($id);
        if(!$securityEvent){
            return false;
        }
        return $securityEvent-> delete();
    }
}
