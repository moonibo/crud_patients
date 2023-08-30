<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriberRequest;
use App\Services\PrescriberService;
use http\Client\Request;
use Illuminate\Http\JsonResponse;

class PrescriberController extends Controller
{
    public function __construct(private readonly PrescriberService $prescriberService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse|array
    {
        $prescribers = $this->prescriberService->index();
        return response()->json(['prescribers' => $prescribers]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse|array
    {
        $prescriber = $this->prescriberService->show($id);
        if (!$prescriber) { return response()->json(['output' => 'This prescriber does not exist']);}
        return response()->json(['prescriber' => $prescriber]);
    }

    public function findConsultationById(int $consultation_id) : JsonResponse|array
    {
        $prescribers = $this->prescriberService->findConsultationById($consultation_id);
        return response()->json(['prescribers' => $prescribers]);
    }

    public function findSpecialityById(int $speciality_id) : JsonResponse|array
    {
        $prescribers = $this->prescriberService->findSpecialityById($speciality_id);
        return response()->json(['prescribers' => $prescribers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrescriberRequest $request) : JsonResponse|array
    {
        $prescriber = $this->prescriberService->store($request->validated());

        return match ($prescriber) {
            'speciality_KO' => response()->json(['output' => 'Prescriber could not be added: Speciality Id does not exist']),
            'consultation_KO' => response()->json(['output' => 'Prescriber could not be added: Consultation Id does not exist']),
            default => response()->json(['output' => 'Prescriber added successfully', 'prescription' => $prescriber]),
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePrescriberRequest $request, string $id) : JsonResponse|array
    {
        $prescriber = $this->prescriberService->update($request->validated(), $id);

        return match ($prescriber) {
            'speciality_KO' => response()->json(['output' => 'Prescriber could not be updated: Speciality Id does not exist']),
            'consultation_KO' => response()->json(['output' => 'Patient could not be updated: Consultation Id does not exist']),
            default => response()->json(['output' => 'Prescriber updated successfully', 'prescription' => $prescriber]),
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id) : ?JsonResponse
    {
        $this->prescriberService->delete($id);
        return response()->json(['output' => 'Prescriber deleted successfully']);
    }


}
