<?php

namespace App\Services\impl;

use App\Models\Service;
use App\Services\ServiceService;

class ServiceServiceImpl implements ServiceService
{
    public function all()
    {
        return Service::included()->filter()->get();
    }

    public function show($id) {
        return Service::with(['events', 'user'])->findOrFail($id);
    }

    public function create(array $data){
        return Service::create($data);
    }
    public function update($id, array $data){
        $service = Service::find($id);
        if(!$service) {
            return null;
        }
        $service->update($data);
        return $service;
    }

    public function delete($id){
        $service = Service::find($id);
        if(!$service){
            return false;
        }
        return $service->delete();
    }
}
