<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts\RegisteredPrescriberInterface;
use App\Models\RegisteredPrescriber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RegisteredPrescriberRepository extends BaseRepository implements RegisteredPrescriberInterface
{
    protected function model(): ?string
    {
        return RegisteredPrescriber::class;
    }

    public function findByMail(string $mail): Model|Builder|null
    {
        return $this->query()->where(['mail' => $mail])->first();
    }
}
