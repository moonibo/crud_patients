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

    public function __invoke(int $id): JsonResponse|int
    {
        $prescription = $this->handler->handle(New FindPrescriptionByIdCommand($id));

        if(is_null($prescription)) {
            return Response::HTTP_NO_CONTENT;
        }

        return response()->json($prescription, Response::HTTP_OK);
    }
}
