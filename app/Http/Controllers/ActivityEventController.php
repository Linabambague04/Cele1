<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreActivityEventRequest;
use App\Http\Requests\UpdateActivityEventRequest;
use App\Services\ActivityEventService;
use Illuminate\Http\Request;

class ActivityEventController extends Controller
{
    protected $activityEventService;

    public function __construct(ActivityEventService $activityEventService)
    {
        $this->activityEventService = $activityEventService;
    }

    public function index(){
        $activityEvent = $this->activityEventService->all();
        return response()->json($activityEvent);
    }
    public function show($id){
        $activityEvent = $this->activityEventService->show($id);

        if(!$activityEvent){
            return response()->json(['message' => 'no encontrado'],404 ); 
        }
        return response()->json($activityEvent);
    }

    public function store(StoreActivityEventRequest $request){
        $activityEvent = $this->activityEventService->create($request->validate());

        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $activityEvent
        ],201);
    }

    public function update(UpdateActivityEventRequest $request, $id){
        $activityEvent = $this->activityEventService->update($id, $request->validate());

        if(!$activityEvent){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$activityEvent]);
    }
    public function destroy($id){
        $activityEvent = $this->activityEventService->delete($id);

        if(!$activityEvent){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
   

}
