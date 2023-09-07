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
        $deleted = $this->handler->handle(New DeletePrescriberCommand($id));

        if(!$deleted) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json(Response::HTTP_OK);
    }
}
