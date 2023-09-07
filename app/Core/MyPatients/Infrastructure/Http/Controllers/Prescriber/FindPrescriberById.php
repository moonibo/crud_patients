<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\FindPrescriberById\FindPrescriberByIdCommand;
use App\Core\MyPatients\Application\Prescriber\FindPrescriberById\FindPrescriberByIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriberById extends Controller
{
    public function __construct(private readonly FindPrescriberByIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $prescriber = $this->handler->handle(New FindPrescriberByIdCommand($id));

        if (is_null($prescriber)) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json($prescriber,Response::HTTP_OK);
    }
}
