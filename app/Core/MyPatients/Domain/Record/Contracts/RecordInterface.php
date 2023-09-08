<?php

namespace App\Core\MyPatients\Domain\Record\Contracts;

interface RecordInterface
{
    public function all();

    public function create(array $attributes);

    public function update (array $attributes, int $id);

    public function find (int $id);

    public function findByPrescriberId (int $prescriber_id);

    public function findByPatientId (int $patient_id);

    public function findRecordsByPatientIdAndPrescriberId (int $patient_id, int $prescriber_id);

    public function findOpenRecordsByPatientAndPrescriberId (int $patient_id, int $prescriber_id);

    public function findLatestOpenRecordByPatientAndPrescriberId (int $patient_id, int $prescriber_id);

    public function delete (int $id);
}
