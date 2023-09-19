<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindPrescriptionByConsultationId\FindPrescriptionByConsultationIdCommand;
use App\Core\MyPatients\Application\Prescription\FindPrescriptionByConsultationId\FindPrescriptionByConsultationIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByConsultationId extends Controller
{
    public function __construct(private readonly FindPrescriptionByConsultationIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse|int
    {
        $prescription = $this->handler->handle(New FindPrescriptionByConsultationIdCommand($id));
        return response()->json($prescription, Response::HTTP_OK);
    }
}
