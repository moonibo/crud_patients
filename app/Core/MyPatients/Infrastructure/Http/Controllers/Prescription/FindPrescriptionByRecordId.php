<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindPrescriptionByRecordId\FindPrescriptionByRecordIdCommand;
use App\Core\MyPatients\Application\Prescription\FindPrescriptionByRecordId\FindPrescriptionByRecordIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByRecordId extends Controller
{
    public function __construct(private readonly FindPrescriptionByRecordIdCommandHandler $handler){}

    public function __invoke(int $id): JsonResponse
    {
        $prescription = $this->handler->handle(New FindPrescriptionByRecordIdCommand($id));
        return response()->json($prescription, Response::HTTP_OK);
    }
}
