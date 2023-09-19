<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientAndPrescriberId;

use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPatientAndPrescriberIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    /**
     * @throws RecordNotFoundException
     */
    public function handle(FindRecordByPatientAndPrescriberIdCommand $command)
    {
        $this->recordFinder->byPatientAndPrescriberIdOrFail($command->patientId(), $command->prescriberId());
        return $this->recordFinder->byPatientAndPrescriberId($command->patientId(), $command->prescriberId());
    }
}
