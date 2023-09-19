<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByRecordId;

use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class FindPrescriptionByRecordIdCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder){}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(FindPrescriptionByRecordIdCommand $command)
    {
        $this->prescriptionFinder->byRecordIdOrFail($command->recordId());
        return $this->prescriptionFinder->byRecordId($command->recordId());
    }
}
