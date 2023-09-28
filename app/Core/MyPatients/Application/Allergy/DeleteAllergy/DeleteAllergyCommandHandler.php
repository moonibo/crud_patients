<?php

namespace App\Core\MyPatients\Application\Allergy\DeleteAllergy;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Core\MyPatients\Domain\Allergy\Services\AllergyFinder;

class DeleteAllergyCommandHandler
{
    public function __construct(private readonly AllergyFinder $allergyFinder,
                                private readonly AllergyInterface $allergy)
    {
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function handle(DeleteAllergyCommand $command): void
    {
        $this->allergyFinder->byIdOrFail($command->allergyId());
        $this->allergy->delete($command->allergyId());
    }
}
