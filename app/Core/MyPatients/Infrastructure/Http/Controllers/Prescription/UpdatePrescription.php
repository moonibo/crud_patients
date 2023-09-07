<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\UpdatePrescription\UpdatePrescriptionCommand;
use App\Core\MyPatients\Application\Prescription\UpdatePrescription\UpdatePrescriptionCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriptionRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePrescription extends Controller
{
    public function __construct(private readonly UpdatePrescriptionCommandHandler $handler){}

    public function __invoke(StorePrescriptionRequest $request, int $id)
    {
        if ($request->validated()) {
            $this->handler->handle(New UpdatePrescriptionCommand([
                'id' => $request->id,
                'prescriber_id' => $request->prescriber_id,
                'patient_id' => $request->patient_id,
                'consultation_id' => $request->consultation_id,
                'record_id' => $request->record_id,
                'doses_per_day' => $request->doses_per_day,
                'days' => $request->days
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}
