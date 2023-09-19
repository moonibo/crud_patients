<?php

namespace App\Core\MyPatients\Application\Record\FindRecordById;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByIdCommandHandler
{
    public function __construct(private readonly RecordInterface $record){}

    public function handle(FindRecordByIdCommand $command)
    {
        return $this->record->find($command->id());
    }
}
