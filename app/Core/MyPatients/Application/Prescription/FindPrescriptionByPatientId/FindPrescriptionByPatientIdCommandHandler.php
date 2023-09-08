<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPatientId;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class FindPrescriptionByPatientIdCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription){}

    public function handle(FindPrescriptionByPatientIdCommand $command)
    {
        return $this->prescription->findByPatientId($command->patientId());
    }
}
