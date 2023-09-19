<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\FindRecordByPatientId\FindRecordByPatientIdCommand;
use App\Core\MyPatients\Application\Record\FindRecordByPatientId\FindRecordByPatientIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindRecordByPatientId extends Controller
{
    public function __construct(private readonly FindRecordByPatientIdCommandHandler $handler)
    {
    }

    public function __invoke(int $patientId): JsonResponse
    {
        $records = $this->handler->handle(new FindRecordByPatientIdCommand($patientId));
        return response()->json($records, Response::HTTP_OK);
    }
}
