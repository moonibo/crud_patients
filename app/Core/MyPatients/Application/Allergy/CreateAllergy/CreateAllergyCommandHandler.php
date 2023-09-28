<?php

namespace App\Core\MyPatients\Application\Allergy\CreateAllergy;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;

class CreateAllergyCommandHandler
{
    public function __construct(private readonly AllergyInterface $allergy)
    {}

    public function handle(CreateAllergyCommand $command): void
    {
        $this->allergy->create($command->allergy());
    }
}
