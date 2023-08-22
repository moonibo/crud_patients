<?php

namespace App\Repositories;

use App\Models\Prescription;
use App\Services\PrescriptionInterface;

class PrescriptionRepository extends BaseRepository implements PrescriptionInterface
{
    protected function model(): ?string
    {
        return Prescription::class;
    }
}
