<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality;


use App\Core\MyPatients\Application\Speciality\UpdateSpeciality\UpdateSpecialityCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Speciality\UpdateSpeciality\UpdateSpecialityCommandHandler;
use App\Http\Requests\StoreSpecialityRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateSpeciality extends Controller
{

    public function __construct(private readonly UpdateSpecialityCommandHandler $handler)
    {
    }

    public function __invoke(StoreSpecialityRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdateSpecialityCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_OK);
    }
}
