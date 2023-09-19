<?php

namespace App\Core\MyPatients\Application\Patient\FindAllPatients;

use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;

class FindAllPatientsCommandHandler
{
    public function __construct(private readonly PatientFinder $patientFinder) {}

    public function handle()
    {
        return $this->patientFinder->findAll();
    }
}
