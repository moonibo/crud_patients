<?php

namespace App\Core\MyPatients\Application\Record\DeleteRecord;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class DeleteRecordCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder,
                                private readonly RecordInterface $record)
    {
    }

    /**
     * @throws RecordNotFoundException
     */
    public function handle(DeleteRecordCommand $command): void
    {
        $this->recordFinder->byIdOrFail($command->id());
        $this->record->delete($command->id());
    }
}
