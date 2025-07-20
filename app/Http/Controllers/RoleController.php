<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleServiceRequest;
use App\Http\Requests\UpdateRoleServiceRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(Role $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(){
        $role = $this->roleService->all();
        return response()->json($role);
    }

    public function show($id){
        $role = $this->roleService->show($id);
        
        if(!$role){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json($role);
    }

    public function store(StoreRoleServiceRequest $request){
        $role = $this->roleService->create($request->validate());
        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $role
        ],201);
    }

    public function update(UpdateRoleServiceRequest $request, $id){
        $role = $this->roleService->update($id, $request->validate());

        if(!$role){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$role]);
    }

    public function destroy($id){
        $role = $this->roleService->delete($id);
        if(!$role){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
