<?php

namespace App\Core\MyPatients\Domain\Step\Contracts;

interface StepInterface
{
    public function all();

    public function create(array $attributes);

    public function update (array $attributes, int $id);

    public function find (int $id);

    public function findByMethodId(int $method_id);

    public function delete (int $id);
}
