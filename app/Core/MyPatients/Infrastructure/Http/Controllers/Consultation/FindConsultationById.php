<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\FindConsultationById\FindConsultationByIdCommand;
use App\Core\MyPatients\Application\Consultation\FindConsultationById\FindConsultationByIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindConsultationById extends Controller
{

    public function __construct(private readonly FindConsultationByIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $consultation = $this->handler->handle(new FindConsultationByIdCommand($id));
        return response()->json($consultation, Response::HTTP_FOUND);
    }
}
