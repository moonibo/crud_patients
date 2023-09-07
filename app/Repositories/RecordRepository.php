<?php

namespace App\Repositories;

use App\Models\Record;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;


class RecordRepository extends BaseRepository implements RecordInterface
{
    protected function model(): ?string
    {
        return Record::class;
    }

}
