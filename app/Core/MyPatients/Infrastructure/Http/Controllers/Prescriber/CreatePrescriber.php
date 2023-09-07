<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\CreatePrescriber\CreatePrescriberCommand;
use App\Core\MyPatients\Application\Prescriber\CreatePrescriber\CreatePrescriberCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriberRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePrescriber extends Controller
{
    public function __construct(private readonly CreatePrescriberCommandHandler $handler)
    {
    }

    public function __invoke(StorePrescriberRequest $request): JsonResponse
    {
        if ($request->validated()) {
            $this->handler->handle(new CreatePrescriberCommand([
                'name' => $request->name,
                'speciality_id' => $request->speciality_id,
                'consultation_id' => $request->consultation_id
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }

        return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}
