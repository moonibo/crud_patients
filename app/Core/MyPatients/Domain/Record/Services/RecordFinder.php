<?php

namespace App\Core\MyPatients\Domain\Record\Services;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;

class RecordFinder
{
    public function __construct(private readonly RecordInterface $record)
    {
    }

    public function exists(int $id)
    {
        $exists = $this->record->exists($id);
        if (!$exists) {
            throw new RecordNotFoundException();
        }
    }

    public function byId(int $id)
    {
        return $this->record->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $record = $this->byId($id);
        if ($record == null) {
            throw new RecordNotFoundException();
        }
    }
}
