<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\DeleteConsultation\DeleteConsultationCommand;
use App\Core\MyPatients\Application\Consultation\DeleteConsultation\DeleteConsultationCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteConsultation extends Controller
{
    public function __construct(private readonly DeleteConsultationCommandHandler $handler)
    {}

    public function __invoke(int $id): JsonResponse
    {
        $deleted = $this->handler->handle(new DeleteConsultationCommand($id));

        if (!$deleted) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json(Response::HTTP_OK);
    }
}
