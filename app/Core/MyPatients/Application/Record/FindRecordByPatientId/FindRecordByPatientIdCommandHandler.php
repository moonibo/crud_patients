<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientId;

use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPatientIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    public function handle(FindRecordByPatientIdCommand $command)
    {
        return $this->recordFinder->byPatientId($command->patientId());
    }
}
