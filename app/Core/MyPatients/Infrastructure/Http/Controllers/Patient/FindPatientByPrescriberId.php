<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;



use App\Core\MyPatients\Application\Patient\FindPatientByPrescriberId\FindPatientByPrescriberIdCommand;
use App\Core\MyPatients\Application\Patient\FindPatientByPrescriberId\FindPatientByPrescriberIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPatientByPrescriberId extends Controller
{

    public function __construct(private readonly FindPatientByPrescriberIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $patient = $this->handler->handle(New FindPatientByPrescriberIdCommand($id));
        return response()->json($patient, Response::HTTP_OK);
    }
}
