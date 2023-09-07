<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\CreatePrescription\CreatePrescriptionCommand;
use App\Core\MyPatients\Application\Prescription\CreatePrescription\CreatePrescriptionCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriptionRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePrescription extends Controller
{
    public function __construct(private readonly CreatePrescriptionCommandHandler $handler){}


    public function __invoke(StorePrescriptionRequest $request): JsonResponse
    {
        if ($request->validated()) {
            $this->handler->handle(new CreatePrescriptionCommand([
                'prescriber_id' => $request->prescriber_id,
                'patient_id' => $request->patient_id,
                'consultation_id' => $request->consultation_id,
                'record_id' => $request->record_id,
                'doses_per_day' => $request->doses_per_day,
                'days' => $request->days
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }

        return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
