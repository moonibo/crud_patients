<?php

namespace App\Core\MyPatients\Application\Allergy\FindAllergyById;

use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Core\MyPatients\Domain\Allergy\Services\AllergyFinder;

class FindAllergyByIdCommandHandler
{
    public function __construct(private readonly AllergyFinder $allergyFinder){}

    /**
     * @throws AllergyNotFoundException
     */
    public function handle(FindAllergyByIdCommand $command)
    {
        $this->allergyFinder->byIdOrFail($command->allergyId());
        return $this->allergyFinder->byId($command->allergyId());
    }
}
