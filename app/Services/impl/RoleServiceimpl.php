<?php

namespace App\Services\impl;
use App\Services\RoleService;
use App\Models\Role;

class RoleServiceimpl implements RoleService
{
    
    public function all()
    {
        return Role::included()->filter()->get();
    }

    public function show($id)
    {
        return Role::with('event')->find($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update($id, array $data)
    {
        $role = Role::find($id);
        if(!$role){
            return null;
        }
        $role->update($data);
        return $role;
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if(!$role){
            return false;
        }
        return $role->delete();
    }
}
