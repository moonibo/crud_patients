<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Services\ConsultationService;
use Illuminate\Http\JsonResponse;

class ConsultationController extends Controller
{
    public function __construct(private readonly ConsultationService $consultationService)
    {
    }

    public function index() : JsonResponse|array
    {
        $consultations = $this->consultationService->index();
        return response()->json(['consultations' => $consultations]);
    }

    public function show (int $id) : JsonResponse|array
    {
        $consultation = $this->consultationService->show($id);
        if (!$consultation) { return response()->json(['output' => 'This consultation does not exist']);}
        return response()->json(['consultation' => $consultation]);
    }

    public function store (StoreConsultationRequest $request) : JsonResponse|array
    {
        $consultation = $this->consultationService->store($request->validated());
        return response()->json(['output' => 'Consultation added successfully', 'consultation' => $consultation]);
    }

    public function update (StoreConsultationRequest $request, int $id) : JsonResponse|array
    {
        $consultation = $this->consultationService->update($request->validated(), $id);
        return response()->json(['output' => 'Consultation updated successfully', 'consultation' => $consultation]);
    }

    public function delete (int $id) : ?JsonResponse
    {
        $this->consultationService->delete($id);
        return response()->json(['output' => 'Consultation deleted successfully']);

    }
}
