<?php

namespace App\Repositories;

use App\Models\Prescription;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Models\PrescriptionPathologies;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PrescriptionRepository extends BaseRepository implements PrescriptionInterface
{
    protected function model(): ?string
    {
        return Prescription::class;
    }

    public function create(array $attributes): Model|Builder
    {
        $record_pathologies = new RecordPathologiesRepository();
        $record_id = $attributes['prescription']['record_id'];

        $prescription =  $this->query()->create($attributes['prescription']);
        $record_pathologies->updateOrCreateRecordPathologies($record_id, $attributes['pathologies']);
        $prescription->pathologies()->attach($attributes['pathologies']);
        return $prescription;
    }

    public function find(int $id): ?Model
    {
        return $this->query()->with('step.method')->find($id);
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
