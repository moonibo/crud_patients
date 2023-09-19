<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientAndPrescriberId;

use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPatientAndPrescriberIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    public function handle(FindRecordByPatientAndPrescriberIdCommand $command)
    {
        return $this->recordFinder->byPatientAndPrescriberId($command->patientId(), $command->prescriberId());
    }
}
