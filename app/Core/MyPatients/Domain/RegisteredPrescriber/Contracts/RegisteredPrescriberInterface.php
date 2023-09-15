<?php

namespace App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts;

interface RegisteredPrescriberInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findByMail(string $mail);

    public function delete(int $id);
}
