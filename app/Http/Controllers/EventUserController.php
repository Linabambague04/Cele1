<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventUserServiceRequest;
use App\Services\EventUserService;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    protected $eventUserService;

    public function __construct(EventUserService $eventUserService)
    {
        $this->eventUserService = $eventUserService;
    }

    public function index(){
        $eventUserService = $this->eventUserService->all();
        return response()->json($eventUserService);
    }

    public function show($id){
        $eventUserService = $this->eventUserService->show($id);
        if(!$eventUserService){
            return response()->json(['message'=>'no encontrado'], 404);
        }
        return response($eventUserService);
    }

    public function update(UpdateEventUserServiceRequest $request, $id){
        $eventUserService = $this->eventUserService->update($id, $request->validate());
        if(!$eventUserService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=>'Actualizado correctamente', 'data'=>$eventUserService]);        
    }

    public function destroy($id){
        $eventUserService = $this->eventUserService->delete($id);

        if(!$eventUserService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=>'Eliminado correctamente']);

    }
}
