<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportServiceRequest;
use App\Http\Requests\UpdateSupportServiceRequest;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $supportService;

    public function __construct(Support $supportService)
    {
        $this->supportService = $supportService;
    }

    public function index(){
        $support = $this->supportService->all();
        return response()->json($support);
    }

    public function show($id){
        $support = $this->supportService->show($id);
        
        if(!$support){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json($support);
    }

    public function store(StoreSupportServiceRequest $request){
        $support = $this->supportService->create($request->validate());
        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $support
        ],201);
    }

    public function update(UpdateSupportServiceRequest $request, $id){
        $support = $this->supportService->update($id, $request->validate());

        if(!$support){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$support]);
    }

    public function destroy($id){
        $support = $this->supportService->delete($id);
        if(!$support){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
