<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality;

use App\Core\MyPatients\Application\Patient\CreatePatient\CreatePatientCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Speciality\CreateSpeciality\CreateSpecialityCommand;
use App\Core\MyPatients\Application\Speciality\CreateSpeciality\CreateSpecialityCommandHandler;
use App\Http\Requests\StoreSpecialityRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateSpeciality extends Controller
{
    public function __construct(private readonly CreateSpecialityCommandHandler $handler)
    {}

    public function __invoke(StoreSpecialityRequest $request): JsonResponse
    {
        $this->handler->handle(new CreateSpecialityCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);

    }
}

