<?php

namespace App\Core\MyPatients\Application\Speciality\CreateSpeciality;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class CreateSpecialityCommandHandler
{
    public function __construct(private readonly SpecialityInterface $speciality)
    {}

    public function handle(CreateSpecialityCommand $command): void
    {
        $this->speciality->create([...$command->speciality()]);
    }
}
