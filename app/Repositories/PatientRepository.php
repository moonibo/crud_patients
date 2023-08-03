<?php

namespace App\Repositories;

use App\Models\Patient;


class PatientRepository extends BaseRepository
{
    protected function model(): ?string
    {
        return Patient::class;
    }

}
