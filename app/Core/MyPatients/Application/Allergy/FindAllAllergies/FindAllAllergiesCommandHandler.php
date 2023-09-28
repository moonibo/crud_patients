<?php

namespace App\Core\MyPatients\Application\Allergy\FindAllAllergies;

use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Core\MyPatients\Domain\Allergy\Services\AllergyFinder;

class FindAllAllergiesCommandHandler
{
    public function __construct(private readonly AllergyFinder $allergyFinder)
    {
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function handle()
    {
        $allergies = $this->allergyFinder->findAll();
        if ($allergies == null) {
            throw new AllergyNotFoundException();
        }
        return $allergies;
    }
}
