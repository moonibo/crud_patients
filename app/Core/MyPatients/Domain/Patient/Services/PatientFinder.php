<?php

namespace App\Core\MyPatients\Domain\Patient\Services;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;

class PatientFinder
{
    public function __construct(private readonly PatientInterface $patient)
    {
    }

    /**
     * @throws PatientNotFoundException
     */
    public function exists(int $id): void
    {
        $exists = $this->patient->exists($id);
        if (!$exists) {
            throw new PatientNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->patient->all();
    }

    public function byId(int $id)
    {
        return $this->patient->find($id);
    }

    /**
     * @throws PatientNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $patient = $this->byId($id);
        if ($patient == null) {
            throw new PatientNotFoundException();
        }
    }

    public function byPrescriberId(int $prescriber_id)
    {
        return $this->patient->findByPrescriberId($prescriber_id);
    }

    public function byPrescriberIdOrFail(int $prescriber_id): void
    {
        $patient = $this->byPrescriberId($prescriber_id);
        if ($patient == null) {
            throw new PatientNotFoundException();
        }
    }
}
