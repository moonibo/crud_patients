<?php

namespace App\Core\MyPatients\Domain\Prescriber\Contracts;

interface PrescriberInterface
{
    public function all();

    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function findByConsultationId(int $consultation_id);

    public function findBySpecialityId (int $speciality_id);

    public function delete(int $id);
}
