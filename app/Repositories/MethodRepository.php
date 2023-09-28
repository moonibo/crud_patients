<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;
use App\Models\Method;

class MethodRepository extends BaseRepository implements MethodInterface
{
    protected function model(): ?string
    {
        return Method::class;
    }

}
