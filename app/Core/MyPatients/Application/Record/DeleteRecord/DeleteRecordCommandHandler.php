<?php

namespace App\Core\MyPatients\Application\Record\DeleteRecord;

use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class DeleteRecordCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder)
    {
    }

    public function handle(DeleteRecordCommand $command)
    {
        return $this->recordFinder->byId($command->id());
    }
}
