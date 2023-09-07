<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality;

use App\Core\MyPatients\Application\Speciality\FindAllSpecialities\FindAllSpecialitiesCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllSpecialities extends Controller
{
    public function __construct(private readonly FindAllSpecialitiesCommandHandler $handler)
    {}

    public function __invoke(): JsonResponse
    {
        $specialities = $this->handler->handle();

        if(is_null($specialities)) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($specialities, Response::HTTP_OK);
    }
}
