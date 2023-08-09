<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Services\PatientInterface;


class PatientRepository extends BaseRepository implements PatientInterface
{
    protected function model(): ?string
    {
        return Patient::class;
    }

}
