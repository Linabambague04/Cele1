<?php

namespace App\Services\impl;

use App\Models\Feedback;
use App\Services\FeedbackService;

class FeedbackServiceImpl implements FeedbackService
{
    public function all()
    {
        return Feedback::included()->filter()->get();
    }

    public function show($id) {
        return Feedback::with(['events', 'user'])->findOrFail($id);
    }

    public function create(array $data){
        return Feedback::create($data);
    }
    public function update($id, array $data){
        $eventUser = Feedback::find($id);
        if(!$eventUser) {
            return null;
        }
        $eventUser->update($data);
        return $eventUser;
    }

    public function delete($id){
        $eventUser = Feedback::find($id);
        if(!$eventUser){
            return false;
        }
        return $eventUser->delete();
    }
}
