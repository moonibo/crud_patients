<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Services\PrescriptionService;
use Illuminate\Http\JsonResponse;

class PrescriptionController extends Controller
{
    public function __construct(private readonly PrescriptionService $prescriptionService)
    {
    }

    public function index() : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->index();
        return response()->json(['prescriptions' => $prescriptions]);
    }

    public function show (int $id) : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->show($id);
        if (!$prescriptions) { return response()->json(['output' => 'This prescription does not exist']);}
        return response()->json(['prescription' => $prescriptions]);
    }

    public function findPrescriberById (int $prescriber_id) : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->findPrescriberById($prescriber_id);
        return response()->json(['prescriptions' => $prescriptions]);
    }

    public function findPatientById (int $patient_id) : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->findPatientById($patient_id);
        return response()->json(['prescriptions' => $prescriptions]);
    }

    public function findConsultationById (int $consultation_id) : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->findConsultationById($consultation_id);
        return response()->json(['prescriptions' => $prescriptions]);
    }

    public function findRecordById (int $record_id) : JsonResponse|array
    {
        $prescriptions = $this->prescriptionService->findRecordById($record_id);
        return response()->json(['prescriptions' => $prescriptions]);
    }

    public function store (StorePrescriptionRequest $request) : JsonResponse|array
    {
        $prescription = $this->prescriptionService->store($request->validated());

        return match ($prescription) {
            'prescriber_KO' => response()->json(['output' => 'Prescription could not be added: Prescriber Id does not exist']),
            'patient_KO' => response()->json(['output' => 'Prescription could not be added: Patient Id does not exist']),
            'consultation_KO' => response()->json(['output' => 'Prescription could not be added: Consultation Id does not exist']),
            'record_KO' => response()->json(['output' => 'Prescription could not be added: Record Id does not exist']),
            default => response()->json(['output' => 'Prescription added successfully', 'prescription' => $prescription]),
        };

    }

    public function update (StorePrescriptionRequest $request, int $id) : JsonResponse|array
    {
        $prescription = $this->prescriptionService->update($request->validated(), $id);

        return match ($prescription) {
            'prescriber_KO' => response()->json(['output' => 'Prescription could not be updated: Prescriber Id does not exist']),
            'patient_KO' => response()->json(['output' => 'Prescription could not be updated: Patient Id does not exist']),
            'consultation_KO' => response()->json(['output' => 'Prescription could not be updated: Consultation Id does not exist']),
            'record_KO' => response()->json(['output' => 'Prescription could not be updated: Record Id does not exist']),
            default => response()->json(['output' => 'Prescription updated successfully', 'prescription' => $prescription]),
        };
    }

    public function delete (int $id) : ?JsonResponse
    {
        $this->prescriptionService->delete($id);
        return response()->json(['output' => 'Prescription deleted successfully']);

    }
}
