<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Step;


use App\Core\MyPatients\Application\Step\FindAllSteps\FindAllStepsCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllSteps extends Controller
{
    public function __construct(private readonly FindAllStepsCommandHandler $handler)
    {}

    public function __invoke(int $method_id): JsonResponse
    {
        $steps = $this->handler->handle();
        return response()->json($steps, Response::HTTP_FOUND);
    }
}
