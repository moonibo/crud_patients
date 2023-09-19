<?php

namespace App\Core\MyPatients\Domain\Consultation\Services;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;

class ConsultationFinder
{
    public function __construct(private readonly ConsultationInterface $consultation)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->consultation->exists($id);
        if (!$exists) {
            throw new ConsultationNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->consultation->all();
    }

    public function byId(int $id)
    {
        return $this->consultation->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $consultation = $this->byId($id);
        if ($consultation == null) {
            throw new ConsultationNotFoundException();
        }
    }
}
