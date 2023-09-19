<?php

namespace App\Core\MyPatients\Domain\Speciality\Services;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Exceptions\SpecialityNotFoundException;

class SpecialityFinder
{
    public function __construct(private readonly SpecialityInterface $speciality)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->speciality->exists($id);
        if (!$exists) {
            throw new SpecialityNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->speciality->all();
    }

    public function byId(int $id)
    {
        return $this->speciality->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $speciality = $this->byId($id);
        if ($speciality == null) {
            throw new SpecialityNotFoundException();
        }
    }
}
