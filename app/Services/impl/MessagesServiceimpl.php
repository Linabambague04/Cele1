<?php

namespace App\Services\impl;

use App\Services\MessagesService;
use App\Models\Message;

class MessagesServiceimpl implements MessagesService
{
    public function all()
    {
        return Message::included()->filter()->get();
    }

    public function show ($id)
    {
        return Message::with(['sender', 'receiver'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Message::create($data);
    }
    public function update($id, array $data)
    {
        $message = Message::find($id);
        if (!$message) {
            return null;
        }
        $message->update($data);
        return $message;
    }

    public function delete($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return false;
        }
        return $message->delete();
    }
}
