<?php

namespace App\Core\MyPatients\Application\Allergy\UpdateAllergy;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Core\MyPatients\Domain\Allergy\Services\AllergyFinder;

class UpdateAllergyCommandHandler
{
    public function __construct(private readonly AllergyInterface $allergy,
                                private readonly AllergyFinder $allergyFinder)
    {}

    /**
     * @throws AllergyNotFoundException
     */
    public function handle(UpdateAllergyCommand $command): void
    {
        $this->allergyFinder->byIdOrFail($command->allergyId());
        $this->allergy->update($command->allergy(), $command->allergyId());
    }
}
