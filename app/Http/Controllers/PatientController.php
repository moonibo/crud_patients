<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientsRequest;
use App\Services\PatientService;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    public function __construct(
        private readonly PatientService $patientService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse|array
    {
        $patients = $this->patientService->index();
        return response()->json(['patients' => $patients]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse|array
    {
        $patient = $this->patientService->show($id);
        if (!$patient) { return response()->json(['output' => 'This patient does not exist']);}
        return response()->json(['patient' => $patient]);
    }

    public function findPrescriber(int $prescriber_id) : JsonResponse|array
    {
        $patients = $this->patientService->findPrescriber($prescriber_id);
        return response()->json(['patients' => $patients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientsRequest $request) : JsonResponse|array
    {
        $patient = $this->patientService->store($request->validated());
        return response()->json(['output' => 'Patient added successfully', 'patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePatientsRequest $request, string $id) : JsonResponse|array
    {
        $patient = $this->patientService->update($request->validated(), $id);
        return response()->json(['output' => 'Patient updated successfully', 'patient' => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id) : ?JsonResponse
    {
        $this->patientService->delete($id);
        return response()->json(['output' => 'Patient deleted successfully']);
    }
}
