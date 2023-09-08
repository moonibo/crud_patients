<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\CreatePatient\CreatePatientCommandHandler;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\CreatePatient\CreatePatientCommand;
use App\Http\Requests\StorePatientRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePatient extends Controller
{

    public function __construct(private readonly CreatePatientCommandHandler $handler)
    {
    }

    public function __invoke(StorePatientRequest $request): int|JsonResponse
    {
        $this->handler->handle(new CreatePatientCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);

    }
}
