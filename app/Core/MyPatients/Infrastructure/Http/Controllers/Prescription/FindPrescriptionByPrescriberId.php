<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindPrescriptionByPrescriberId\FindPrescriptionByPrescriberIdCommand;
use App\Core\MyPatients\Application\Prescription\FindPrescriptionByPrescriberId\FindPrescriptionByPrescriberIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByPrescriberId extends Controller
{
    public function __construct(private readonly FindPrescriptionByPrescriberIdCommandHandler $handler){}

    public function __invoke(int $id): JsonResponse
    {
        $prescription = $this->handler->handle(New FindPrescriptionByPrescriberIdCommand($id));
        return response()->json($prescription, Response::HTTP_OK);
    }
}
