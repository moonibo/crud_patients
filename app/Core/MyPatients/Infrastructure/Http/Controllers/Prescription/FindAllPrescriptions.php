<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\FindAllPrescriptions\FindAllPrescriptionsCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllPrescriptions extends Controller
{
    public function __construct(private readonly FindAllPrescriptionsCommandHandler $handler)
    {
    }

    public function __invoke(): JsonResponse|int
    {
        $prescriptions = $this->handler->handle();

        if (is_null($prescriptions)) {
            return Response::HTTP_NO_CONTENT;
        }

        return response()->json($prescriptions, Response::HTTP_OK);
    }
}
