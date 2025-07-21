<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
      protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index(){
        $feedbackService = $this->feedbackService->all();
        return response()->json($feedbackService);
    }

    public function show($id){
        $feedbackService = $this->feedbackService->show($id);
        if(!$feedbackService){
            return response()->json(['message'=>'no encontrado'], 404);
        }
        return response($feedbackService);
    }
    public function store (StoreFeedbackRequest $request){
        $feedbackService = $this->feedbackService->create($request->validate());

        return response()->json([
            'message' => 'Evento creado con exito',
            'data'  => $feedbackService
        ],201);
    }


    public function update(UpdateFeedbackRequest $request, $id){
       $feedbackService = $this->feedbackService->update($id, $request->validate());
        if(!$feedbackService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=>'Actualizado correctamente', 'data'=>$feedbackService]);        
    }

    public function destroy($id){
        $feedbackService = $this->feedbackService->delete($id);

        if(!$feedbackService){
            return response()->json(['message'=>'No encontrado'], 404);
        }
        return response()->json(['message'=>'Eliminado correctamente']);

    }
}
