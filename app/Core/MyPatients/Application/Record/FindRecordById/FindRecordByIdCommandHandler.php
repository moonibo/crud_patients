<?php

namespace App\Core\MyPatients\Application\Record\FindRecordById;

use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class FindRecordByIdCommandHandler
{
    public function __construct(private readonly RecordFinder $recordFinder){}

    /**
     * @throws RecordNotFoundException
     */
    public function handle(FindRecordByIdCommand $command)
    {
        $this->recordFinder->byIdOrFail($command->id());
        return $this->recordFinder->byId($command->id());
    }
}
