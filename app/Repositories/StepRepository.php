<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;
use App\Models\Step;
use Illuminate\Database\Eloquent\Collection;

class StepRepository extends BaseRepository implements StepInterface
{
    protected function model(): ?string
    {
        return Step::class;
    }

    public function findByMethodId(int $method_id): Collection|array
    {
        return $this->query()->where(['method_id' => $method_id])->get();
    }

}
