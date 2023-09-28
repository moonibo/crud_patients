<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology;

use App\Core\MyPatients\Application\Pathology\UpdatePathology\UpdatePathologyCommand;
use App\Core\MyPatients\Application\Pathology\UpdatePathology\UpdatePathologyCommandHandler;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePathologyRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdatePathology extends Controller
{
    public function __construct(private readonly UpdatePathologyCommandHandler $handler)
    {
    }

    /**
     * @throws PathologyNotFoundException
     */
    public function __invoke(int $id, StorePathologyRequest $request): JsonResponse
    {
        $this->handler->handle(new UpdatePathologyCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
