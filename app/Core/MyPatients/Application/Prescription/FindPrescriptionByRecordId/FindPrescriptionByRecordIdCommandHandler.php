<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByRecordId;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class FindPrescriptionByRecordIdCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription){}

    public function handle(FindPrescriptionByRecordIdCommand $command)
    {
        return $this->prescription->findRecordById($command->recordId());
    }
}
