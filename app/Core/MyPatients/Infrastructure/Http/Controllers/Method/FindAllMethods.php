<?php


namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Method;

use App\Core\MyPatients\Application\Method\FindAllMethods\FindAllMethodsCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllMethods extends Controller
{
    public function __construct(private readonly FindAllMethodsCommandHandler $handler)
    {
    }

    public function __invoke(): JsonResponse
    {
        $methods = $this->handler->handle();
        return response()->json($methods, Response::HTTP_CREATED);
    }
}
