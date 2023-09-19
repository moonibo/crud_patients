<?php

namespace App\Core\MyPatients\Application\Record\CreateRecord;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;

class CreateRecordCommandHandler
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder){}

    /**
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     */
    public function handle(CreateRecordCommand $command): void
    {
        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());

        $this->record->create($command->record());
    }
}
