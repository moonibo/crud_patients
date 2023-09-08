<?php

namespace App\Repositories;

use App\Models\Record;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;


class RecordRepository extends BaseRepository implements RecordInterface
{
    protected function model(): ?string
    {
        return Record::class;
    }

    public function findRecordsByPatientIdAndPrescriberId (int $patient_id, int $prescriber_id) : array|Collection
    {
        return $this->query()->where(['patient_id' => $patient_id, 'prescriber_id' => $prescriber_id])->get();
    }

    public function findOpenRecordsByPatientAndPrescriberId (int $patient_id, int $prescriber_id)
    {
        return $this->query()->where(['patient_id' => $patient_id, 'prescriber_id' => $prescriber_id])->where('end_date', '>', Carbon::now());
    }

    public function findLatestOpenRecordByPatientAndPrescriberId(int $patient_id, int $prescriber_id)
    {
        return $this->query()->where(['patient_id' => $patient_id, 'prescriber_id' => $prescriber_id])
            ->where('end_date', '>', Carbon::now())
            ->latest('created_at')
            ->first();
    }

}
