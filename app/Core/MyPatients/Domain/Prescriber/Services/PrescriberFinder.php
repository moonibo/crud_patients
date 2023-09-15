<?php

namespace App\Core\MyPatients\Domain\Prescriber\Services;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;

class PrescriberFinder
{
    public function __construct(private readonly PrescriberInterface $prescriber)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->prescriber->exists($id);
        if (!$exists) {
            throw new PrescriberNotFoundException();
        }
    }

    public function byId(int $id)
    {
        return $this->prescriber->find($id);
    }

    public function byIdOrFail(int $id): void
    {
        $prescriber = $this->byId($id);
        if ($prescriber == null) {
            throw new PrescriberNotFoundException();
        }
    }
}
