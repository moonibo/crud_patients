<?php

namespace App\Core\MyPatients\Application\Speciality\FindAllSpecialities;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class FindAllSpecialitiesCommandHandler
{
    public function __construct(private readonly SpecialityInterface $speciality)
    {
    }

    public function handle()
    {
        return $this->speciality->all();
    }
}
