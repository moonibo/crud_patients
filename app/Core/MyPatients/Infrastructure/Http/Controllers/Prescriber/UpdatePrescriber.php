<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\UpdatePrescriber\UpdatePrescriberCommand;
use App\Core\MyPatients\Application\Prescriber\UpdatePrescriber\UpdatePrescriberCommandHandler;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriberRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdatePrescriber extends Controller
{
    public function __construct(private readonly UpdatePrescriberCommandHandler $handler){}

    public function __invoke(StorePrescriberRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdatePrescriberCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
