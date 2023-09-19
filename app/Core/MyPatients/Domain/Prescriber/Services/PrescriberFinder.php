<?php

namespace App\Core\MyPatients\Domain\Prescriber\Services;

use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;

class PrescriberFinder
{
    public function __construct(private readonly PrescriberInterface $prescriber)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->prescriber->exists($id);
        if (!$exists) {
            throw new PrescriberNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->prescriber->all();
    }

    public function byId(int $id)
    {
        return $this->prescriber->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $prescriber = $this->byId($id);
        if ($prescriber == null) {
            throw new PrescriberNotFoundException();
        }
    }

    public function byConsultationId(int $consultation_id)
    {
        return $this->prescriber->findByConsultationId($consultation_id);
    }

    public function byConsultationIdOrFail(int $consultation_id): void
    {
        $prescriber = $this->byConsultationId($consultation_id);
        if ($prescriber == null) {
            throw new PrescriberNotFoundException();
        }
    }

    public function bySpecialityId(int $speciality_id)
    {
        return $this->prescriber->findBySpecialityId($speciality_id);
    }

    public function bySpecialityIdOrFail(int $speciality_id): void
    {
        $prescriber = $this->bySpecialityId($speciality_id);
        if ($prescriber == null) {
            throw new PrescriberNotFoundException();
        }
    }
}
