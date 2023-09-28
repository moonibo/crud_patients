<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology;

use App\Core\MyPatients\Application\Pathology\FindPathologyById\FindPathologyByIdCommand;
use App\Core\MyPatients\Application\Pathology\FindPathologyById\FindPathologyByIdCommandHandler;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPathologyById extends Controller
{
    public function __construct(private readonly FindPathologyByIdCommandHandler $handler)
    {
    }

    /**
     * @throws PathologyNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $pathology = $this->handler->handle(new FindPathologyByIdCommand($id));
        return response()->json($pathology, Response::HTTP_OK);
    }
}
