<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    public function index(){
        $event = $this->eventService->all();
        return response()->json($event);        
    }
    
    public function show($id){
        $event = $this->eventService->show($id);

        if(!$event){
            return response()->json(['message' => 'Evento no encontrado'],404);
        }
        return response()->json($event);
    }

    public function store (StoreEventRequest $request){
        $event = $this->eventService->create($request->validate());

        return response()->json([
            'message' => 'Evento creado con exito',
            'data'  => $event
        ],201);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = $this->eventService->update($id, $request->validated());

        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json(['message' => 'Evento actualizado correctamente', 'data' => $event]);
    }
    public function destroy($id)
    {
        $event = $this->eventService->delete($id);

        if (!$event) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
