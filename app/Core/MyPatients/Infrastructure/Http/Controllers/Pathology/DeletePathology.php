<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology;

use App\Core\MyPatients\Application\Pathology\DeletePathology\DeletePathologyCommand;
use App\Core\MyPatients\Application\Pathology\DeletePathology\DeletePathologyCommandHandler;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePathology extends Controller
{
    public function __construct(private readonly DeletePathologyCommandHandler $handler){}

    /**
     * @throws PathologyNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeletePathologyCommand($id));
        return response()->json(null, Response::HTTP_OK);
    }
}
