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
        return response()->json(['patients' => $prescribers]);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrescriberRequest $request) : JsonResponse|array
    {
        $prescriber = $this->prescriberService->store($request->validated());
        return response()->json(['output' => 'Prescriber added successfully', 'Prescriber' => $prescriber]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : JsonResponse|array
    {
        $prescriber = $this->prescriberService->update((array)$request, $id);

        return response()->json(['output' => 'Prescriber updated successfully', 'Prescriber' => $prescriber]);
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
