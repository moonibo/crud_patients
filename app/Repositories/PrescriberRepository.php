<?php

namespace App\Repositories;

use App\Models\Prescriber;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PrescriberRepository extends BaseRepository implements PrescriberInterface
{
    protected function model(): ?string
    {
        return Prescriber::class;
    }

    public function findBySpecialityId (int $speciality_id) : Builder|Model
    {
        return $this->query()->where(['speciality_id' => $speciality_id])->first();
    }
}
