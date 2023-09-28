<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\CreatePrescription\CreatePrescriptionCommand;
use App\Core\MyPatients\Application\Prescription\CreatePrescription\CreatePrescriptionCommandHandler;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriptionRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePrescription extends Controller
{
    public function __construct(private readonly CreatePrescriptionCommandHandler $handler){}


    /**
     * @throws ConsultationNotFoundException
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     */
    public function __invoke(StorePrescriptionRequest $request): JsonResponse
    {
        $this->handler->handle(new CreatePrescriptionCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);

    }
}
