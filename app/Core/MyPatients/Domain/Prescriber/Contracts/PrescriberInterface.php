<?php

namespace App\Core\MyPatients\Domain\Prescriber\Contracts;

interface PrescriberInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findConsultationById(int $consultation_id);

    public function findSpecialityById (int $speciality_id);

    public function delete(int $id);
}
