<?php

namespace App\Core\MyPatients\Domain\Allergy\Services;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;

class AllergyFinder
{
    public function __construct(private readonly AllergyInterface $allergy)
    {
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function exists(int $id): void
    {
        $exists = $this->allergy->exists($id);
        if (!$exists) {
            throw new AllergyNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->allergy->all();
    }

    public function byId(int $id)
    {
        return $this->allergy->find($id);
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $allergy = $this->byId($id);
        if ($allergy == null) {
            throw new AllergyNotFoundException();
        }
    }
}
