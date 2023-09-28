<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Method;

use App\Core\MyPatients\Application\Method\CreateMethod\CreateMethodCommand;
use App\Core\MyPatients\Application\Method\CreateMethod\CreateMethodCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMethodRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateMethod extends Controller
{
    public function __construct(private readonly CreateMethodCommandHandler $handler)
    {}

    public function __invoke(StoreMethodRequest $request): JsonResponse
    {
        $this->handler->handle(new CreateMethodCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
