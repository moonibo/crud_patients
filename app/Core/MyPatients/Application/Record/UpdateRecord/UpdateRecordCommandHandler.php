<?php

namespace App\Core\MyPatients\Application\Record\UpdateRecord;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class UpdateRecordCommandHandler
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder,
                                private readonly RecordFinder $recordFinder){}

    public function handle(UpdateRecordCommand $command)
    {
        $this->recordFinder->byIdOrFail($command->id());
        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());

        $this->record->update($command->record(), $command->id());

    }
}
