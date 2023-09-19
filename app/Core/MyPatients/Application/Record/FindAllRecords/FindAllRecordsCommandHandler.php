<?php

namespace App\Core\MyPatients\Application\Record\FindAllRecords;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;

class FindAllRecordsCommandHandler
{
    public function __construct(private readonly RecordInterface $record){}

    public function handle()
    {
        return $this->record->all();
    }
}
