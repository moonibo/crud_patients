<?php

namespace App\Core\MyPatients\Domain\Patient\Contracts;


interface PatientInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findByPrescriberId(int $prescriber_id);

    public function delete(int $id);

}
