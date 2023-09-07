<?php

namespace App\Core\MyPatients\Domain\Speciality\Contracts;

interface SpecialityInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function delete(int $id);
}
