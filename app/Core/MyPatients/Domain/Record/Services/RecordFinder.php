<?php

namespace App\Core\MyPatients\Domain\Record\Services;

use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;

class RecordFinder
{
    public function __construct(private readonly RecordInterface $record)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->record->exists($id);
        if (!$exists) {
            throw new RecordNotFoundException();
        }
    }

    public function byId(int $id)
    {
        return $this->record->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $record = $this->byId($id);
        if ($record == null) {
            throw new RecordNotFoundException();
        }
    }
    public function byPrescriberId(int $prescriberId)
    {
        return $this->record->findByPrescriberId($prescriberId);
    }

    public function byPrescriberIdOrFail(int $prescriberId): void
    {
        $records = $this->byPrescriberId($prescriberId);
        if ($records == null) {
            throw new RecordNotFoundException();
        }
    }

    public function byPatientId(int $patientId)
    {
        return $this->record->findByPatientId($patientId);
    }

    public function byPatientIdOrFail(int $patientId): void
    {
        $records = $this->byPrescriberId($patientId);
        if ($records == null) {
            throw new RecordNotFoundException();
        }
    }

    public function byPatientAndPrescriberId(int $patientId, int $prescriberId)
    {
        return $this->record->findRecordsByPatientIdAndPrescriberId($patientId, $prescriberId);
    }

    public function byPatientAndPrescriberIdOrFail(int $patientId, int $prescriberId)
    {
        $records = $this->byPatientAndPrescriberId($patientId, $prescriberId);
        if ($records->isEmpty()) {
            throw new RecordNotFoundException();
        }
    }
}
