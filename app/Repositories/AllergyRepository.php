<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;
use App\Models\Allergy;

class AllergyRepository extends BaseRepository implements AllergyInterface
{
    public function model(): ?string
    {
        return Allergy::class;
    }
}
