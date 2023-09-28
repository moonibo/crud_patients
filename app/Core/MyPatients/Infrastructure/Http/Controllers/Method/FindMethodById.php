<?php


namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Method;

use App\Core\MyPatients\Application\Method\FindMethodById\FindMethodByIdCommand;
use App\Core\MyPatients\Application\Method\FindMethodById\FindMethodByIdCommandHandler;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindMethodById extends Controller
{
    public function __construct(private readonly FindMethodByIdCommandHandler $handler)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $method = $this->handler->handle(new FindMethodByIdCommand($id));
        return response()->json($method, Response::HTTP_CREATED);
    }
}
