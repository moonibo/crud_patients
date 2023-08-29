<?php

namespace App\Services;

class PrescriptionService
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient,
                                private readonly ConsultationInterface $consultation,
                                private readonly RecordInterface $record
    ){
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

    public function findExistingIds (array $attributes): bool|string
    {
        if (!$this->prescriber->find($attributes['prescriber_id'])) {
            return 'prescriber_KO';
        }

        if (!$this->patient->find($attributes['patient_id'])) {
            return 'patient_KO';
        }

        if (!$this->consultation->find($attributes['consultation_id'])) {
            return 'consultation_KO';
        }

        if (!$this->record->find($attributes['record_id'])) {
            return 'record_KO';
        }
        return 'OK';
    }

    public function store (array $attributes)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->prescription->create($attributes);
        } else {
            return $message;
        }
    }

    public function update (array $attributes, int $id)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->prescription->update($attributes, $id);
        } else {
            return $message;
        }
    }

    public function delete (int $id)
    {
        return $this->prescription->delete($id);
    }
}
