<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected function model(): ?string
    {
        return null;
    }
    protected function query(): Builder
    {
        return app($this->model())->newQuery();
    }

    public function all(?array $columns = ['*']): Collection|array
    {
        return $this->query()->get($columns);
    }

    public function create(array $attributes): Model|Builder
    {
        return $this->query()->create($attributes);
    }

    public function update(array $attributes, int $id): Model|Builder
    {
        $this->query()->where(['id' => $id])->update($attributes);

        return $this->find($id);
    }

    public function find(int $id): ?Model
    {
        return $this->query()->find($id);
    }

    public function findPrescriberById(int $prescriber_id): array|Collection
    {
        return $this->query()->where(['prescriber_id' => $prescriber_id])->get();
    }

    public function findPatientById(int $patient_id) : array|Collection
    {
        return $this->query()->where(['patient_id' => $patient_id])->get();
    }

    public function findConsultationById(int $consultation_id) : array|Collection
    {
        return $this->query()->where(['consultation_id' => $consultation_id])->get();
    }

    public function findSpecialityById (int $speciality_id) : array|Collection
    {
        return $this->query()->where(['speciality_id' => $speciality_id])->get();
    }

    public function findRecordById (int $record_id) : array|Collection
    {
        return $this->query()->where(['record_id' => $record_id])->get();
    }

    public function findRecordByPatientIdAndPrescriberId (int $patient_id, int $prescriber_id) : array|Collection
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

    public function delete(int $id): Model|bool
    {
        return $this->query()->find($id)->delete();
    }
}
