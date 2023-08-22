<?php

namespace App\Repositories;

use App\Models\Record;
use App\Services\RecordInterface;


class RecordRepository extends BaseRepository implements RecordInterface
{
    protected function model(): ?string
    {
        return Record::class;
    }

}
