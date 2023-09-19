<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByConsultationId;

use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class FindPrescriptionByConsultationIdCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder)
    {}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(FindPrescriptionByConsultationIdCommand $command)
    {
        $this->prescriptionFinder->byConsultationIdOrFail($command->consultationId());
        return $this->prescriptionFinder->byConsultationId($command->consultationId());
    }
}
