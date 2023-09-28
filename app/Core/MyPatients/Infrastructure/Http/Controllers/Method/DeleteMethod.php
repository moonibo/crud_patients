<?php


namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Method;

use App\Core\MyPatients\Application\Method\DeleteMethod\DeleteMethodCommand;
use App\Core\MyPatients\Application\Method\DeleteMethod\DeleteMethodCommandHandler;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteMethod extends Controller
{
    public function __construct(private readonly DeleteMethodCommandHandler $handler)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeleteMethodCommand($id));
        return response()->json(null, Response::HTTP_OK);
    }
}
