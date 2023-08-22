<?php

namespace App\Services;

interface RecordInterface
{
    public function all();

    public function create(array $attributes);

    public function update (array $attributes, int $id);

    public function find (int $id);

    public function findPrescriberById (int $prescriber_id);

    public function findPatientById (int $patient_id);

    public function findRecordByPatientIdAndPrescriberId (int $patient_id, int $prescriber_id);


    public function delete (int $id);
}
