<?php

namespace App\Repositories;

use App\Models\Prescription;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class PrescriptionRepository extends BaseRepository implements PrescriptionInterface
{
    protected function model(): ?string
    {
        return Prescription::class;
    }
}
