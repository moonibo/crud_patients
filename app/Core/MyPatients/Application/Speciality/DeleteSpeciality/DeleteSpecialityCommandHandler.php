<?php

namespace App\Core\MyPatients\Application\Speciality\DeleteSpeciality;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Exceptions\SpecialityNotFoundException;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class DeleteSpecialityCommandHandler {

    public function __construct (private readonly SpecialityInterface $speciality,
                                private readonly SpecialityFinder $specialityFinder)
    {}

    /**
     * @throws SpecialityNotFoundException
     */
    public function handle(DeleteSpecialityCommand $command)
    {
        $this->specialityFinder->byIdOrFail($command->specialityId());
        return $this->speciality->delete($command->specialityId());
    }
}
