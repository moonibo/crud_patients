<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Services\RecordService;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class RecordController extends Controller
{
    public function __construct(private readonly RecordService $recordService)
    {
    }

    public function index() : JsonResponse|array
    {
        $records = $this->recordService->index();
        return response()->json(['records' => $records]);
    }

    public function show (int $id) : JsonResponse|array
    {
        $record = $this->recordService->show($id);
        if (!$record) { return response()->json(['output' => 'This record does not exist']);}
        return response()->json(['record' => $record]);
    }

    public function findPrescriberById (int $prescriber_id) : JsonResponse|array
    {
        $records = $this->recordService->findPrescriberById($prescriber_id);
        return response()->json(['records' => $records]);
    }

    public function findPatientById (int $patient_id) : JsonResponse|array
    {
        $records = $this->recordService->findPatientById($patient_id);
        return response()->json(['records' => $records]);
    }

    public function showRecordByPatientIdAndPrescriberId (int $patient_id, int $prescriber_id): JsonResponse|array
    {
        $record = $this->recordService->findActiveRecord($patient_id, $prescriber_id);

        if ($record === null | empty($record)) {
            return response()->json(['output' => 'A record with these parameters does not exist']);
        }
        if (Carbon::parse($record[0]->end_date)->isPast()) {
            $newRecord = $this->recordService->createNewRecordWhenExpired($patient_id, $prescriber_id);
            return response()->json(['output' => 'A record with these parameters expired, a new record was created', 'record' => $newRecord]);
        }

        return response()->json(['record' => $record]);
    }

    public function store (StoreRecordRequest $request) : JsonResponse|array
    {
        $record = $this->recordService->store($request->validated());
        return response()->json(['output' => 'Record added successfully', 'record' => $record]);
    }

    public function update (StoreRecordRequest $request, int $id) : JsonResponse|array
    {
        $record = $this->recordService->update($request->validated(), $id);
        return response()->json(['output' => 'Record updated successfully', 'record' => $record]);
    }

    public function delete (int $id) : ?JsonResponse
    {
        $this->recordService->delete($id);
        return response()->json(['output' => 'Record deleted successfully']);

    }
}
