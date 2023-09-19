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
        return response()->json($prescriber,Response::HTTP_OK);
    }
}
