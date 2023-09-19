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

    public function findAll()
    {
        return $this->prescription->all();
    }

    public function byId(int $id)
    {
        return $this->prescription->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $prescription = $this->byId($id);
        if ($prescription === null) {
            throw new PrescriptionNotFoundException();
        }
    }

    public function byConsultationId(int $consultation_id)
    {
        return $this->prescription->findByConsultationId($consultation_id);
    }

    public function byConsultationIdOrFail(int $consultation_id): void
    {
        $prescription = $this->byConsultationId($consultation_id);
        if ($prescription == null) {
            throw new PrescriptionNotFoundException();
        }
    }

    public function byPatientId(int $patient_id)
    {
        return $this->prescription->findByPatientId($patient_id);
    }

    public function byPatientIdOrFail(int $patient_id): void
    {
        $prescription = $this->byPatientId($patient_id);
        if ($prescription == null) {
            throw new PrescriptionNotFoundException();
        }
    }

    public function byPrescriberId(int $prescriber_id)
    {
        return $this->prescription->findByPrescriberId($prescriber_id);
    }

    public function byPrescriberIdOrFail(int $prescriber_id): void
    {
        $prescription = $this->byPrescriberId($prescriber_id);
        if ($prescription == null) {
            throw new PrescriptionNotFoundException();
        }
    }

    public function byRecordId(int $record_id)
    {
        return $this->prescription->findByRecordId($record_id);
    }

    public function byRecordIdOrFail(int $record_id): void
    {
        $prescription = $this->byRecordId($record_id);
        if ($prescription == null) {
            throw new PrescriptionNotFoundException();
        }
    }
}
