<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialityRequest;
use App\Services\SpecialityService;
use http\Client\Request;
use Illuminate\Http\JsonResponse;

class SpecialityController extends Controller
{
    public function __construct(private readonly SpecialityService $specialityService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse|array
    {
        $specialities = $this->specialityService->index();
        return response()->json(['speciality' => $specialities]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse|array
    {
        $speciality = $this->specialityService->show($id);
        if (!$speciality) { return response()->json(['output' => 'This speciality does not exist']);}
        return response()->json(['speciality' => $speciality]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialityRequest $request) : JsonResponse|array
    {
        $speciality = $this->specialityService->store($request->validated());
        return response()->json(['output' => 'Speciality added successfully', 'Speciality' => $speciality]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSpecialityRequest $request, string $id) : JsonResponse|array
    {
        $speciality = $this->specialityService->update($request->validated(), $id);

        return response()->json(['output' => 'Speciality updated successfully', 'Speciality' => $speciality]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id) : ?JsonResponse
    {
        $this->specialityService->delete($id);
        return response()->json(['output' => 'Speciality deleted successfully']);
    }
}
