<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId\FindPrescriberByConsultationIdCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriberByConsultationId extends Controller
{
    public function __construct(private readonly \App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId\FindPrescriberByConsultationIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $prescribers = $this->handler->handle(New FindPrescriberByConsultationIdCommand($id));
        return response()->json($prescribers,Response::HTTP_OK);
    }
}
