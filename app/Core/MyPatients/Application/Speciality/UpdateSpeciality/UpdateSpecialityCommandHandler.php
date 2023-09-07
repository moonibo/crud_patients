<?php

namespace App\Core\MyPatients\Application\Speciality\UpdateSpeciality;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class UpdateSpecialityCommandHandler
{
    public function __construct(private readonly SpecialityInterface $speciality)
    {}

    public function handle(UpdateSpecialityCommand $command)
    {
        if ($this->speciality->find($command->id()) !== null) {
            $this->speciality->update($command->speciality(), $command->id());
        }
    }
}
