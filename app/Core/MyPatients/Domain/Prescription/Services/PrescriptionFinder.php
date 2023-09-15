<?php

namespace App\Core\MyPatients\Domain\Prescription\Services;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;

class PrescriptionFinder
{
    public function __construct(private readonly PrescriptionInterface $prescription)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->prescription->exists($id);
        if (!$exists) {
            throw new PrescriptionNotFoundException();
        }
    }

    public function byId(int $id)
    {
        return $this->prescription->find($id);
    }

    /**
     * @throws PrescriptionNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $prescription = $this->byId($id);
        if ($prescription === null) {
            throw new PrescriptionNotFoundException();
        }
    }
}
