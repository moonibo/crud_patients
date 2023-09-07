<?php

namespace App\Core\MyPatients\Domain\Prescription\Contracts;

interface PrescriptionInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findPrescriberById(int $prescriber_id);

    public function findPatientById (int $patient_id);

    public function findConsultationById(int $consultation_id);

    public function findRecordById (int $record_id);

    public function delete(int $id);
}
