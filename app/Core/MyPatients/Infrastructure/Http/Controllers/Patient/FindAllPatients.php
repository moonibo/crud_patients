<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\FindAllPatients\FindAllPatientsCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\FindAllPatients\FindAllPatientsCommandHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllPatients extends Controller
{

    public function __construct(private readonly FindAllPatientsCommandHandler $handler)
    {
    }

    public function __invoke(): JsonResponse
    {
        $patients = $this->handler->handle();

        if(is_null($patients)) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($patients, Response::HTTP_OK);
    }
}
