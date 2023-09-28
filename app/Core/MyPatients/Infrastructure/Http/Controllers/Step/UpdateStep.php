<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Step;

use App\Core\MyPatients\Application\Step\CreateStep\CreateStepCommand;
use App\Core\MyPatients\Application\Step\CreateStep\CreateStepCommandHandler;
use App\Core\MyPatients\Application\Step\UpdateStep\UpdateStepCommand;
use App\Core\MyPatients\Application\Step\UpdateStep\UpdateStepCommandHandler;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStepRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateStep extends Controller
{
    public function __construct(private readonly UpdateStepCommandHandler $handler)
    {}

    /**
     * @throws MethodNotFoundException
     * @throws StepNotFoundException
     */
    public function __invoke(StoreStepRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdateStepCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}


