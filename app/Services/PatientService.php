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
        $patient = $this->patient->find($id);

        switch($patient["gender"]) {
            case 0:
                $patient["gender"] = "H";
                break;
            case 1:
                $patient["gender"] = "M";
                break;
        }
        return $patient;
    }

    public function findPrescriberById(int $prescriber_id)
    {
        return $this->patient->findPrescriberById($prescriber_id);
    }

    public function store(array $attributes)
    {
        switch($attributes["gender"]) {
            case "H":
                $attributes["gender"] = 0;
                break;
            case "M":
                $attributes["gender"] = 1;
                break;
        }
        return $this->patient->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        switch($attributes["gender"]) {
            case "H":
                $attributes["gender"] = 0;
                break;
            case "M":
                $attributes["gender"] = 1;
                break;
        }

        return $this->patient->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->patient->delete($id);
    }
}
