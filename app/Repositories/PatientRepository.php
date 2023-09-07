<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;


class PatientRepository extends BaseRepository implements PatientInterface
{
    protected function model(): ?string
    {
        return Patient::class;
    }

}
