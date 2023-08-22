<?php

namespace App\Repositories;

use App\Models\Consultation;
use App\Services\ConsultationInterface;


class ConsultationRepository extends BaseRepository implements ConsultationInterface
{
    protected function model(): ?string
    {
        return Consultation::class;
    }

}
