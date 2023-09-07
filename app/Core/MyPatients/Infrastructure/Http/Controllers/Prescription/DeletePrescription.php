<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\DeletePrescription\DeletePrescriptionCommand;
use App\Core\MyPatients\Application\Prescription\DeletePrescription\DeletePrescriptionCommandHandler;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeletePrescription extends Controller
{
    public function __construct(private readonly DeletePrescriptionCommandHandler $handler)
    {
    }

    public function __invoke(int $id): int
    {
        $deleted = $this->handler->handle(New DeletePrescriptionCommand($id));

        if (!$deleted) {
            return Response::HTTP_NO_CONTENT;
        }

        return Response::HTTP_OK;
    }
}
