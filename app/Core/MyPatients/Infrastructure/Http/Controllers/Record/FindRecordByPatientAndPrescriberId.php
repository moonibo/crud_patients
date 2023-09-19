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
        return response()->json($records, Response::HTTP_OK);
    }
}
