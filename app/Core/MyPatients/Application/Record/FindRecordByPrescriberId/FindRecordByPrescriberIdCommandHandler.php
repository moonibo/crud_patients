<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPrescriberId;

use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPrescriberIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    /**
     * @throws RecordNotFoundException
     */
    public function handle(FindRecordByPrescriberIdCommand $command)
    {
        $this->recordFinder->byPrescriberIdOrFail($command->prescriberId());
        return $this->recordFinder->byPrescriberId($command->prescriberId());
    }
}
