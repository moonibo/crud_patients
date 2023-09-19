<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\UpdateConsultation\UpdateConsultationCommand;
use App\Core\MyPatients\Application\Consultation\UpdateConsultation\UpdateConsultationCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateConsultation extends Controller
{
    public function __construct(private readonly UpdateConsultationCommandHandler $handler)
    {

    }

    public function __invoke(StoreConsultationRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdateConsultationCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);

    }
}
