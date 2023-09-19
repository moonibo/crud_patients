<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientId;

use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPatientIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    /**
     * @throws RecordNotFoundException
     */
    public function handle(FindRecordByPatientIdCommand $command)
    {
        $this->recordFinder->byPatientIdOrFail($command->patientId());
        return $this->recordFinder->byPatientId($command->patientId());
    }
}
