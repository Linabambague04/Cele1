<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventResourcesServiceRequest;
use App\Http\Requests\UpdarteEventResourcesServiceRequest;
use App\Http\Requests\UpdateEventResourcesServiceRequest;
use App\Models\ResourceEvent;
use Illuminate\Http\Request;

class ResourceEventController extends Controller
{
    protected $resourceEventService;

    public function __construct(ResourceEvent $resourceEventService)
    {
        $this->resourceEventService = $resourceEventService;
    }

    public function index(){
        $resourceEvent = $this->resourceEventService->all();
        return response()->json($resourceEvent);
    }
    public function show($id){
        $resourceEvent = $this->resourceEventService->show($id);

        if(!$resourceEvent){
            return response()->json(['message' => 'no encontrado'],404 ); 
        }
        return response()->json($resourceEvent);
    }

    public function store(StoreEventResourcesServiceRequest $request){
        $resourceEvent = $this->resourceEventService->create($request->validate());

        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $resourceEvent
        ],201);
    }

    public function update(UpdarteEventResourcesServiceRequest $request, $id){
        $resourceEvent = $this->resourceEventService->update($id, $request->validate());

        if(!$resourceEvent){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$resourceEvent]);
    }
    public function destroy($id){
        $resourceEvent = $this->resourceEventService->delete($id);

        if(!$resourceEvent){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
