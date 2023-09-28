<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Step;

use App\Core\MyPatients\Application\Step\CreateStep\CreateStepCommand;
use App\Core\MyPatients\Application\Step\CreateStep\CreateStepCommandHandler;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStepRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateStep extends Controller
{
    public function __construct(private readonly CreateStepCommandHandler $handler)
    {}

    /**
     * @throws MethodNotFoundException
     */
    public function __invoke(StoreStepRequest $request): JsonResponse
    {
        $this->handler->handle(new CreateStepCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
