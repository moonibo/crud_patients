<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class PrescriptionService
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient,
                                private readonly ConsultationInterface $consultation,
                                private readonly RecordInterface $record,
                                private readonly RecordService $recordService
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
        }

        if ($message === 'record_KO') {
            $record = $this->recordService->findLatestOpenRecordByPatientAndPrescriberId($attributes['patient_id'], $attributes['prescriber_id']);

            if ($record) {
                $record->toArray();
                $attributes['record_id'] = $record['id'];
                return $this->prescription->create($attributes);

            } else {
                $new_record = $this->recordService->createNewRecordWhenExpired($attributes['patient_id'], $attributes['prescriber_id']);
                $attributes['record_id'] = $new_record['id'];
                return $this->prescription->create($attributes);
            }
        }
        return $message;
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
