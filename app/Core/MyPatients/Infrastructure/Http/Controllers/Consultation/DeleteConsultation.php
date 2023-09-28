<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\DeleteConsultation\DeleteConsultationCommand;
use App\Core\MyPatients\Application\Consultation\DeleteConsultation\DeleteConsultationCommandHandler;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteConsultation extends Controller
{
    public function __construct(private readonly DeleteConsultationCommandHandler $handler)
    {}

    /**
     * @throws ConsultationNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeleteConsultationCommand($id));
        return response()->json(Response::HTTP_OK);
    }
}
