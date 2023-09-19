<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPrescriberId;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByPrescriberCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    public function handle(FindRecordByPrescriberIdCommand $command)
    {
        return $this->recordFinder->byPrescriberId($command->prescriberId());
    }
}
