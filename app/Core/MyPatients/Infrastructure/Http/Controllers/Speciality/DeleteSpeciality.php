<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality;

use App\Core\MyPatients\Application\Speciality\DeleteSpeciality\DeleteSpecialityCommand;
use App\Core\MyPatients\Application\Speciality\DeleteSpeciality\DeleteSpecialityCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteSpeciality extends Controller
{
    public function __construct(private readonly DeleteSpecialityCommandHandler $handler)
    {}

    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeleteSpecialityCommand($id));
        return response()->json(Response::HTTP_OK);
    }
}
