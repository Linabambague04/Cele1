<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessagesServiceRequest;
use App\Http\Requests\UpdateMessagesServiceRequest;
use App\Models\Message;
use App\Services\MessagesService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessagesService $messageService)
    {
        $this-> messageService = $messageService;
    }

    public function index(){
        $message = $this->messageService->all();
        return response()->json($message);
    }

    public function show($id){
        $message = $this->messageService->show($id);
        if(!$message){
            return response()->json (['message' => 'no encontrado'], 404);
        }
        return response()->json($message);
    }

    public function store(StoreMessagesServiceRequest $request){
        $message = $this->messageService->create($request->validate());

        return response()->json([
            'message'=>'Mensaje agregado correctamente',
            'data'=>$message
        ],201);
    }

    public function update(UpdateMessagesServiceRequest $request, $id){
        $message = $this->messageService->update($id, $request->validate());

        if(!$message){
            return response()->json(['message'=>'No encontrado',404]);
        }

        return response()->json(['message'=> 'Actualizado correctamente', 'data'=>$message]);
    }

    public function destroy($id){
        $message = $this ->messageService->delete($id);

        if(!$message){
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message'=> 'eliminado correctamente']);
    }
    
}
