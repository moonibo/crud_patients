<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology;

use App\Core\MyPatients\Application\Pathology\CreatePathology\CreatePathologyCommand;
use App\Core\MyPatients\Application\Pathology\CreatePathology\CreatePathologyCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePathologyRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePathology extends Controller
{
    public function __construct(private readonly CreatePathologyCommandHandler $handler){}

    public function __invoke(StorePathologyRequest $request): JsonResponse
    {
        $this->handler->handle(new CreatePathologyCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
