<?php

namespace App\Services\impl;

use App\Models\Notification;
use App\Services\NotificationService;

class NotificationServiceimpl implements NotificationService
{
    public function all(){
        return Notification::included()->filter()->get();
    }
    
    public function show($id){
        return Notification::with(['user'])->findOrFail($id);
    }

    public function create(array $data){
        return Notification::create($data);
    }

    public function update($id, array $data){
        $notification = Notification::find($id);
        if(!$notification){
            return null;
        }
        $notification->update($data);
        return $notification;
    }

    public function delete($id){
        $notification = Notification::find($id);
        if(!$notification){
            return false;
        }
        return $notification->delete();
    }
}
