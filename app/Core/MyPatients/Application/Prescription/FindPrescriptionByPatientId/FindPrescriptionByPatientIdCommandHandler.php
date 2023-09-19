<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPatientId;

use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class FindPrescriptionByPatientIdCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder){}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(FindPrescriptionByPatientIdCommand $command)
    {
        $this->prescriptionFinder->byPatientIdOrFail($command->patientId());
        return $this->prescriptionFinder->byPatientId($command->patientId());
    }
}
