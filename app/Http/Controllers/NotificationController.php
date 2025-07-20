<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationServiceRequest;
use App\Http\Requests\UpdateNotificationServiceRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(Notification $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(){
        $notification = $this->notificationService->all();
        return response()->json($notification);
    }

    public function show($id){
        $notification = $this->notificationService->show($id);
        if(!$notification){
            return response()->json(['message' => 'No enontrado'], 404);
        }
        return response()->json($notification);
    }

    public function store(StoreNotificationServiceRequest $request){
        $notification = $this->notificationService->create($request->validate());

        return response()->json([
            'massage' => 'Notificacion agregada correctamente',
            'data' => $notification
        ],201);
    }

    public function update(UpdateNotificationServiceRequest $request, $id){
        $notification = $this->notificationService->update($id, $request->validate());
        if(!$notification){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json(['message'=>'Actualizado correctamente','data'=>$notification]);
    }

    public function destroy($id){
        $notification = $this->notificationService->delete($id);

        if(!$notification){
            return response()->json(['message'=>'No encontrado'], 404);           
        }
        return response()->json(['message'=>'Eliminado correctamente']);
    }
}
