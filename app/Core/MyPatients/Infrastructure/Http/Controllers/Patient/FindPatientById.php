<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\FindPatientById\FindPatientByIdCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\FindPatientById\FindPatientByIdCommandHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPatientById extends Controller
{

    public function __construct(private readonly FindPatientByIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $patient = $this->handler->handle(New FindPatientByIdCommand($id));
        return response()->json($patient,Response::HTTP_OK);
    }
}
