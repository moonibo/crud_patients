<?php

namespace App\Repositories;

use App\Models\Consultation;
use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;


class ConsultationRepository extends BaseRepository implements ConsultationInterface
{
    protected function model(): ?string
    {
        return Consultation::class;
    }

}
