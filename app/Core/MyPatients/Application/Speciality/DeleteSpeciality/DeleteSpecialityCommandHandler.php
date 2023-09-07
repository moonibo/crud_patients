<?php

namespace App\Core\MyPatients\Application\Speciality\DeleteSpeciality;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class DeleteSpecialityCommandHandler {

    public function __construct (private readonly SpecialityInterface $speciality)
    {}

    public function handle(DeleteSpecialityCommand $command)
    {

        if ($this->speciality->find($command->specialityId()) !== null) {
            return $this->speciality->delete($command->specialityId());
        } else {
            return false;
        }
    }
}
