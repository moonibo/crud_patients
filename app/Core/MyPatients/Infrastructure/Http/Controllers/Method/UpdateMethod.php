<?php


namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Method;

use App\Core\MyPatients\Application\Method\UpdateMethod\UpdateMethodCommand;
use App\Core\MyPatients\Application\Method\UpdateMethod\UpdateMethodCommandHandler;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMethodRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateMethod extends Controller
{
    public function __construct(private readonly UpdateMethodCommandHandler $handler)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function __invoke(StoreMethodRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdateMethodCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
