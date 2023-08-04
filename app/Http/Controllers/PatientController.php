<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use App\Repositories\PatientRepository;

class PatientController extends Controller
{
    public function __construct(private readonly PatientRepository $patientRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse|array
    {
        $patients = $this->patientRepository->all();
        return response()->json(['patients' => $patients]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse|array
    {
        $patient = $this->patientRepository->find($id);
        if (!$patient) { return response()->json(['output' => 'This patient does not exist']);}
        return response()->json(['patients' => $patient]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request) : JsonResponse|array
    {
        $patient = $this->patientRepository->create($request->validated());
        return response()->json(['output' => 'Patient added successfully', 'patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePatientRequest $request, string $id) : JsonResponse|array
    {
        $patient = $this->patientRepository->find($id);

        if ($request->validated()) {
            $patient->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'mail' => $request->mail,
                'gender' => $request->gender,
            ]);
            $patient->save();
        }

        return response()->json(['output' => 'Patient updated successfully', 'patient' => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id) : ?JsonResponse
    {
        $this->patientRepository->delete($id);
        return response()->json(['output' => 'Patient deleted successfully']);
    }
}
