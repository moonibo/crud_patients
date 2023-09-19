<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\FindRecordByPatientAndPrescriberId\FindRecordByPatientAndPrescriberIdCommand;
use App\Core\MyPatients\Application\Record\FindRecordByPatientAndPrescriberId\FindRecordByPatientAndPrescriberIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindRecordByPatientAndPrescriberId extends Controller
{
    public function __construct(private readonly FindRecordByPatientAndPrescriberIdCommandHandler $handler)
    {
    }

    public function __invoke(int $patientId, int $prescriberId): JsonResponse
    {
        $records = $this->handler->handle(new FindRecordByPatientAndPrescriberIdCommand($patientId, $prescriberId));
        if ($records->isEmpty()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json($records, Response::HTTP_OK);
    }
}
