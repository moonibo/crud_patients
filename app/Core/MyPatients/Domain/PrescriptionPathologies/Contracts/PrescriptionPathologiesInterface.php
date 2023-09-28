<?php

namespace App\Core\MyPatients\Domain\PrescriptionPathologies\Contracts;

interface PrescriptionPathologiesInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function delete(int $id);
}
