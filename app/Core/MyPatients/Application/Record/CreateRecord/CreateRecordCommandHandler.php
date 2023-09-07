<?php

namespace App\Core\MyPatients\Application\Record\CreateRecord;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;

class CreateRecordCommandHandler
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient){}

    public function handle(CreateRecordCommand $command)
    {
        if (is_null($this->prescriber->find($command->prescriberId()))) {
            return false;
        }

        if (is_null($this->patient->find($command->patientId()))) {
            return false;
        }

        $this->record->create($command->record());
    }
}
