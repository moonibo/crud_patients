<?php

namespace App\Core\MyPatients\Application\Speciality\FindAllSpecialities;

use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class FindAllSpecialitiesCommandHandler
{
    public function __construct(private readonly SpecialityFinder $specialityFinder)
    {
    }
    public function handle()
    {
        return $this->specialityFinder->findAll();
    }
}
