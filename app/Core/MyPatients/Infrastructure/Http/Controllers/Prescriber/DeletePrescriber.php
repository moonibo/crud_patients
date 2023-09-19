<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\DeletePrescriber\DeletePrescriberCommand;
use App\Core\MyPatients\Application\Prescriber\DeletePrescriber\DeletePrescriberCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePrescriber extends Controller
{
    public function __construct(private readonly DeletePrescriberCommandHandler $handler
    )
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(New DeletePrescriberCommand($id));
        return response()->json(Response::HTTP_OK);
    }
}
