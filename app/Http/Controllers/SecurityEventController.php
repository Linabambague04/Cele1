<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSecurityEventServiceRequest;
use App\Http\Requests\UpdatewSecurityEventServiceRequest;
use App\Services\SecurityEventsService;
use Illuminate\Http\Request;
class SecurityEventController extends Controller
{
    protected $securityEventsService;

    public function __construc(SecurityEventsService $securityEventsService){
            $this->securityEventsService = $securityEventsService;
    }

    public function index(){
        $securityEvent = $this->securityEventsService->all();
        return response()->json($securityEvent);
    }

    public function show($id){
        $securityEvent = $this ->securityEventsService->show($id);
        
        if(!$securityEvent){
            return response()->json(['message' => 'no encontrador' ],404);
        }
        return response()->json($securityEvent);
    }

    public function store(StoreSecurityEventServiceRequest $request){
        $securityEvent = $this->securityEventsService->create($request->validate());

        return response()->json(['messge'=>'Agregado correctamente', 'data'=>$securityEvent],201);
    }

    public function update(UpdatewSecurityEventServiceRequest $request, $id){
        $securityEvent = $this->securityEventsService->update($id, $request->validate());

        if(!$securityEvent){
            return response()->json(['message'=>'no encontrado'], 404);
        }

        return response()->json((['message' =>'Eliminado correctamente']));
    }
}
