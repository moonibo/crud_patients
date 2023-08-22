<?php

namespace App\Services;

use App\Models\Record;
use Carbon\Carbon;

class RecordService
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriptionInterface $prescription)
    {
    }

    public function index()
    {
        return $this->record->all();
    }

    public function show (int $id)
    {
        return $this->record->find($id);
    }

    public function findPrescriberById (int $prescriber_id)
    {
        return $this->record->findPrescriberById($prescriber_id);
    }

    public function findPatientById (int $patient_id)
    {
        return $this->record->findPatientById($patient_id);
    }

    public function store (array $attributes)
    {
        return $this->record->create($attributes);
    }

    public function update (array $attributes, int $id)
    {
        return $this->record->update($attributes, $id);
    }

    public function delete (int $id)
    {
        return $this->record->delete($id);
    }

    public function findActiveRecord(int $patient_id, int $prescriber_id)
    {
        $record = $this->record->findRecordByPatientIdAndPrescriberId($patient_id, $prescriber_id);

        if (empty($record[0])) { return null; }

        return $record;
    }

    public function createNewRecordWhenExpired(int $patient_id, int $prescriber_id)
    {
        $new_record_attr = [
            'prescriber_id' => $prescriber_id,
            'patient_id' => $patient_id,
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addMonths(3)->toDateString(),
        ];

        $created_record = $this->record->create($new_record_attr);
        $this->createNewPrescriptionWhenRecordExpired($created_record);

        return $created_record;
    }

    public function createNewPrescriptionWhenRecordExpired (Record $record): void
    {
        $new_prescription_attr = [
            'prescriber_id' => $record->prescriber_id,
            'patient_id' => $record->patient_id,
            'consultation_id' => null,
            'record_id' => $record->id,
            'doses_per_day' => null,
            'days' => null,
        ];

        $this->prescription->create($new_prescription_attr);
    }
}
