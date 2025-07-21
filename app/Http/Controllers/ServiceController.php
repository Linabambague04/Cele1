<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceServiceRequest;
use App\Http\Requests\UpdateServiceServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $ServiceService;

    public function __construct(Service $ServiceService)
    {
        $this->ServiceService = $ServiceService;
    }

    public function index(){
        $ServiceService = $this->ServiceService->all();
        return response()->json($ServiceService);
    }

    public function show($id){
        $ServiceService = $this->ServiceService->show($id);
        
        if(!$ServiceService){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json($ServiceService);
    }

    public function store(StoreServiceServiceRequest $request){
        $ServiceService = $this->ServiceService->create($request->validate());
        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $ServiceService
        ],201);
    }

    public function update(UpdateServiceServiceRequest $request, $id){
        $ServiceService = $this->ServiceService->update($id, $request->validate());

        if(!$ServiceService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$ServiceService]);
    }

    public function destroy($id){
        $ServiceService = $this->ServiceService->delete($id);
        if(!$ServiceService){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
