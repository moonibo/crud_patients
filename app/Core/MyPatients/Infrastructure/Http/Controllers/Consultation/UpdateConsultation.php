<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\UpdateConsultation\UpdateConsultationCommand;
use App\Core\MyPatients\Application\Consultation\UpdateConsultation\UpdateConsultationCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateConsultation extends Controller
{
    public function __construct(private readonly UpdateConsultationCommandHandler $handler)
    {

    }

    public function __invoke(StoreConsultationRequest $request, int $id)
    {
        if ($request->validated()) {
            $this->handler->handle(new UpdateConsultationCommand([
                'id' => $request->id,
                'name' => $request->name
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }

        return response()->json(null, Response::HTTP_NOT_FOUND);
    }
}
