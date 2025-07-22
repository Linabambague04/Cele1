<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(User $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $userService = $this->userService->all();
        return response()->json($userService);
    }

    public function show($id){
        $userService = $this->userService->show($id);
        
        if(!$userService){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json($userService);
    }

    public function store(StoreUserRequest $request){
        $userService = $this->userService->create($request->validate());
        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $userService
        ],201);
    }

    public function update(UpdateUserRequest $request, $id){
        $userService = $this->userService->update($id, $request->validate());

        if(!$userService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$userService]);
    }

    public function destroy($id){
        $userService = $this->userService->delete($id);
        if(!$userService){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
