<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateConsultationCommand;
use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateConsultationCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateConsultation extends Controller
{
    public function __construct(private readonly CreateConsultationCommandHandler $handler)
    {}

    public function __invoke(StoreConsultationRequest $request): JsonResponse
    {
        $this->handler->handle(new CreateConsultationCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
