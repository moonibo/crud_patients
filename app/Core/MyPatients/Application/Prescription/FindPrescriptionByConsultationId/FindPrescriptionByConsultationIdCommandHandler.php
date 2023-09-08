<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByConsultationId;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class FindPrescriptionByConsultationIdCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription)
    {}

    public function handle(FindPrescriptionByConsultationIdCommand $command)
    {
        return $this->prescription->findByConsultationId($command->consultationId());
    }
}
