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
        if ($request->validated()) {
            $this->handler->handle(new UpdateSpecialityCommand([
                'id' => $request->id,
                'name' => $request->name
            ]));
            return response()->json(Response::HTTP_OK);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
