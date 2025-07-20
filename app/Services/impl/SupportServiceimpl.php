<?php

namespace App\Services\impl;

use App\Models\Support;

class SupportServiceimpl
{ 
    public function all()
    {
        return Support::included()->filter()->get();
    }

    public function show($id)
    {
        return Support::with('event')->find($id);
    }

    public function create(array $data)
    {
        return Support::create($data);
    }

    public function update($id, array $data)
    {
        $role = Support::find($id);
        if(!$role){
            return null;
        }
        $role->update($data);
        return $role;
    }

    public function delete($id)
    {
        $role = Support::find($id);
        if(!$role){
            return false;
        }
        return $role->delete();
    }
}
