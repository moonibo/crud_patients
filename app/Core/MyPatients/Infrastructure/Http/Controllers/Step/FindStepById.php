<?php
namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Step;

use App\Core\MyPatients\Application\Step\FindStepById\FindStepByIdCommand;
use App\Core\MyPatients\Application\Step\FindStepById\FindStepByIdCommandHandler;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindStepById extends Controller
{
    public function __construct(private readonly FindStepByIdCommandHandler $handler)
    {}

    /**
     * @throws StepNotFoundException
     */
    public function __invoke(int $method_id): JsonResponse
    {
        $step = $this->handler->handle(new FindStepByIdCommand($method_id));
        return response()->json($step, Response::HTTP_CREATED);
    }
}

