<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindPrescriptionById\FindPrescriptionByIdCommand;
use App\Core\MyPatients\Application\Prescription\FindPrescriptionById\FindPrescriptionByIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionById extends Controller
{
    public function __construct(private readonly FindPrescriptionByIdCommandHandler $handler){}

    public function __invoke(int $id): JsonResponse
    {
        $prescription = $this->handler->handle(New FindPrescriptionByIdCommand($id));
        return response()->json($prescription, Response::HTTP_OK);
    }
}
