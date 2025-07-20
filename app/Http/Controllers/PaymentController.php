<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentsServiceRequest;
use App\Http\Requests\UpdatePaymentsServiceRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentsService;

    public function __construct(PaymentService $paymentsService)
    {
        $this->paymentsService = $paymentsService;
    }

    public function index(){
        $payments = $this->paymentsService->all();
        return response()->json($payments);
    }

    public function show($id){
        $payments = $this->paymentsService->show($id);
        
        if(!$payments){
            return response()->json(['message'=>'No encontrado'],404);
        }
        return response()->json($payments);
    }

    public function store(StorePaymentsServiceRequest $request){
        $payments = $this->paymentsService->create($request->validate());
        return response()->json([
            'message' => 'Actividad Agregada correctamente.',
            'data' => $payments
        ],201);
    }

    public function update(UpdatePaymentsServiceRequest $request, $id){
        $payments = $this->paymentsService->update($id, $request->validate());

        if(!$payments){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=> 'Actualizado correctamente','data'=>$payments]);
    }

    public function destroy($id){
        $payments = $this->paymentsService->delete($id);
        if(!$payments){
            return response()->json(['message' => 'No encontrado'], 404);            
        }
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
