<?php

namespace App\Services;

class PrescriptionService
{
    public function __construct(private readonly PrescriptionInterface $prescription){
    }

    public function index()
    {
        return $this->prescription->all();
    }

    public function show (int $id)
    {
        return $this->prescription->find($id);
    }

    public function findPrescriberById (int $prescriber_id)
    {
        return $this->prescription->findPrescriberById($prescriber_id);
    }

    public function findPatientById (int $patient_id)
    {
        return $this->prescription->findPatientById($patient_id);
    }

    public function findConsultationById (int $consultation_id)
    {
        return $this->prescription->findConsultationById($consultation_id);
    }

    public function findRecordById (int $record_id)
    {
        return $this->prescription->findRecordById($record_id);
    }

    public function store (array $attributes)
    {
        return $this->prescription->create($attributes);
    }

    public function update (array $attributes, int $id)
    {
        return $this->prescription->update($attributes, $id);
    }

    public function delete (int $id)
    {
        return $this->prescription->delete($id);
    }
}
