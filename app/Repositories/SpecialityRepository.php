<?php

namespace App\Repositories;

use App\Models\Speciality;
use \App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class SpecialityRepository extends BaseRepository implements SpecialityInterface
{
    protected function model(): ?string
    {
        return Speciality::class;
    }
}
