<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology;

use App\Core\MyPatients\Application\Pathology\FindAllPathologies\FindAllPathologiesCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllPathologies extends Controller
{
    public function __construct(private readonly FindAllPathologiesCommandHandler $handler){}

    public function __invoke(): JsonResponse
    {
        $pathologies = $this->handler->handle();
        return response()->json($pathologies, Response::HTTP_OK);
    }
}
