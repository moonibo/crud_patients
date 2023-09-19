<?php

namespace App\Core\MyPatients\Application\Record\FindAllRecords;

use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindAllRecordsCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder){}

    public function handle()
    {
        return $this->recordFinder->findAll();
    }
}
