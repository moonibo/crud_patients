<?php

namespace App\Services;

class PrescriberService
{
    public function __construct(
        private readonly PrescriberInterface $prescriber
    ) {
    }

    public function index()
    {
        return $this->prescriber->all();
    }

    public function show(int $id)
    {
        return $this->prescriber->find($id);
    }

    public function findConsultationById(int $consultation_id)
    {
        return $this->prescriber->findConsultationById($consultation_id);
    }

    public function findSpecialityById (int $speciality_id)
    {
        return $this->prescriber->findSpecialityById($speciality_id);
    }

    public function store(array $attributes)
    {
        return $this->prescriber->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->prescriber->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->prescriber->delete($id);
    }


}
