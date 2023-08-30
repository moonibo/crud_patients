<?php

namespace App\Services;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RecordService
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient,
                                private readonly PrescriptionInterface $prescription,
    )
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

    public function findExistingIds (array $attributes): bool|string
    {
        if (!$this->prescriber->find($attributes['prescriber_id'])) {
            return 'prescriber_KO';
        }

        if (!$this->patient->find($attributes['patient_id'])) {
            return 'patient_KO';
        }
        return 'OK';
    }

    public function store (array $attributes)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->record->create($attributes);
        } else {
            return $message;
        }
    }

    public function update (array $attributes, int $id)
    {
        $message = $this->findExistingIds($attributes);

        if ($message === 'OK') {
            return $this->record->update($attributes, $id);
        } else {
            return $message;
        }
    }

    public function delete (int $id)
    {
        return $this->record->delete($id);
    }

    public function findRecordByPatientIdAndPrescriberId(int $patient_id, int $prescriber_id)
    {
        $record = $this->record->findRecordByPatientIdAndPrescriberId($patient_id, $prescriber_id);

        if (Carbon::parse($record[0]->end_date)->isPast()) {
            $new_record = $this->createNewRecordWhenExpired($patient_id, $prescriber_id);
            $this->createNewPrescriptionWhenExpired($new_record);
            return $new_record;
        }

        return $record;
    }

    public function findActiveRecords($records): array
    {
        $open_records = new Collection();
        $closed_records = new Collection();

        foreach ($records as $record)
            if (Carbon::parse($record['end_date'])->isPast()) {
                $closed_records->push($record);
            } else {
                $open_records->push($record);
            }

        return ['open' => $open_records,
                'closed' => $closed_records];
    }

    public function createNewRecordWhenExpired(int $patient_id, int $prescriber_id)
    {
        $new_record_attr = [
            'prescriber_id' => $prescriber_id,
            'patient_id' => $patient_id,
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addMonths(3)->toDateString(),
        ];

        return $this->record->create($new_record_attr);
    }

    public function createNewPrescriptionWhenExpired (Record $record): void
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
