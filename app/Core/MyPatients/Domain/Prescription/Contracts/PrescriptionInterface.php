<?php

namespace App\Core\MyPatients\Domain\Prescription\Contracts;

interface PrescriptionInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findByPrescriberId(int $prescriber_id);

    public function findByPatientId (int $patient_id);

    public function findByConsultationId(int $consultation_id);

    public function findByRecordId (int $record_id);

    public function setEditableToFalseUpdatedOlderThanFifteenMinutes();

    public function delete(int $id);
}
