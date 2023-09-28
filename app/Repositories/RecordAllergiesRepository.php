<?php

namespace App\Repositories;

use App\Models\RecordAllergies;
use App\Core\MyPatients\Domain\RecordAllergies\Contracts\RecordAllergiesInterface;

class RecordAllergiesRepository extends BaseRepository implements RecordAllergiesInterface
{
    public function model(): ?string
    {
        return RecordAllergies::class;
    }
}
