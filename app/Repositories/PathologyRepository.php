<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;
use App\Models\Pathology;

class PathologyRepository extends BaseRepository implements PathologyInterface
{
    public function model(): ?string
    {
        return Pathology::class;
    }
}
