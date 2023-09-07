<?php

namespace App\Repositories;

use App\Models\Prescriber;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;

class PrescriberRepository extends BaseRepository implements PrescriberInterface
{
    protected function model(): ?string
    {
        return Prescriber::class;
    }
}
