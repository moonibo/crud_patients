<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId\FindPrescriberByConsultationIdCommand;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriberByConsultationId extends Controller
{
    public function __construct(private readonly \App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId\FindPrescriberByConsultationIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id)
    {
        $prescribers = $this->handler->handle(New FindPrescriberByConsultationIdCommand($id));

        if (empty($prescribers->toArray())) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($prescribers,Response::HTTP_OK);
    }
}
