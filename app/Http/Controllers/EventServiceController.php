<?php

namespace App\Http\Controllers;
use App\Services\EventServiceService;
use App\Models\EventService;
use App\Http\Requests\StoreEventServiceRequest;
use App\Http\Requests\UpdateEventServiceRequest;
use Illuminate\Http\Request;

class EventServiceController extends Controller
{
    protected $eventServiceService;

    public function __construct(EventServiceService $eventServiceService){
        $this->eventServiceService = $eventServiceService;
    }
    public function index()
    {
        $eventServiceService = $this->eventServiceService->all();
        return response()->json($eventServiceService);
    }

    public function show($id)
    {
        $eventServiceService = $this->eventServiceService->show($id);

        if (!$eventServiceService) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($eventServiceService);
    }

    public function store(StoreEventServiceRequest $request)
    {
        $eventServiceService = $this->eventServiceService->create($request->validated());

        return response()->json([
            'message' => 'Producto agregado a la factura correctamente.',
            'data' => $eventServiceService
        ], 201);
    }

    public function update(UpdateEventServiceRequest $request, $id)
    {
        $eventServiceService = $this->eventServiceService->update($id, $request->validated());

        if (!$eventServiceService) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $eventServiceService]);
    }

    public function destroy($id)
    {
        $eventServiceService = $this->eventServiceService->delete($id);

        if (!$eventServiceService) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Eliminado correctamente']);
    }


}
