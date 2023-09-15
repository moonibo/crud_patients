<?php

namespace App\Repositories;

use App\Models\Prescription;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PrescriptionRepository extends BaseRepository implements PrescriptionInterface
{
    protected function model(): ?string
    {
        return Prescription::class;
    }

    public function findByRecordId (int $record_id) : array|Collection
    {
        return $this->query()->where(['record_id' => $record_id])->get();
    }

    public function setEditableToFalseUpdatedOlderThanFifteenMinutes(): int
    {
        return $this->query()->where('updated_at', '<', Carbon::now()->subMinutes(15))->update(['is_editable' => false]);
    }


}
