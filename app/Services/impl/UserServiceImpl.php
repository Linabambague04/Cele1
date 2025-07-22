<?php

namespace App\Services\impl;

use App\Models\User;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    public function all()
    {

        return User::included()->filter()->get();
    }

    public function show($id)
    {
        return User::with('userroles', 'events', 'feedbacks', 'payments', 'eventusers', 'notifications', 'supports', 'resourceevents', 'messages', 'serviceusers');
    }
    
    public function create(array $data)
    {
        return User::created($data);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }
}
