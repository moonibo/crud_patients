<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindPrescriptionByPatientId\FindPrescriptionByPatientIdCommand;
use App\Core\MyPatients\Application\Prescription\FindPrescriptionByPatientId\FindPrescriptionByPatientIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByPatientId extends Controller
{
    public function __construct(private readonly FindPrescriptionByPatientIdCommandHandler $handler){}

    public function __invoke(int $id): JsonResponse|int
    {
        $prescription = $this->handler->handle(New FindPrescriptionByPatientIdCommand($id));
        return response()->json($prescription, Response::HTTP_OK);
    }
}
