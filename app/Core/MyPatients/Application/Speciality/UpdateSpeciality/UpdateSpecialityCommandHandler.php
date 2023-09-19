<?php

namespace App\Core\MyPatients\Application\Speciality\UpdateSpeciality;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Exceptions\SpecialityNotFoundException;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class UpdateSpecialityCommandHandler
{
    public function __construct(private readonly SpecialityInterface $speciality,
                                private readonly SpecialityFinder $specialityFinder)
    {}

    /**
     * @throws SpecialityNotFoundException
     */
    public function handle(UpdateSpecialityCommand $command): void
    {
        $this->specialityFinder->byIdOrFail($command->id());
        $this->speciality->update($command->speciality(), $command->id());

    }
}
