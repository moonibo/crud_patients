<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Step;

use App\Core\MyPatients\Application\Step\DeleteStep\DeleteStepCommand;
use App\Core\MyPatients\Application\Step\DeleteStep\DeleteStepCommandHandler;
use App\Core\MyPatients\Application\Step\FindStepById\FindStepByIdCommand;
use App\Core\MyPatients\Application\Step\FindStepById\FindStepByIdCommandHandler;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteStep extends Controller
{
    public function __construct(private readonly DeleteStepCommandHandler $handler)
    {
    }

    /**
     * @throws StepNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeleteStepCommand($id));
        return response()->json(null, Response::HTTP_OK);
    }
}
