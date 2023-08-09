<?php

namespace App\Services;

class PatientService
{
    public function __construct(
        private readonly PatientInterface $patient
    ) {
    }

    public function index()
    {
        return $this->patient->all();
    }

    public function show(int $id)
    {
        return $this->patient->find($id);
    }

    public function findPrescriber(int $prescriber_id)
    {
        return $this->patient->findPrescriber($prescriber_id);
    }

    public function store(array $attributes)
    {
        $attributes["gender"] = $attributes["gender"] === "H" ? 0 : 1;
        return $this->patient->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        $attributes["gender"] = $attributes["gender"] === "H" ? 0 : 1;

        return $this->patient->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->patient->delete($id);
    }
}
