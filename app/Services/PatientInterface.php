<?php

namespace App\Services;

interface PatientInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findPrescriber(int $prescriber_id);

    public function delete(int $id);
}
