<?php

namespace App\Core\MyPatients\Application\Patient\FindAllPatients;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;

class FindAllPatientsCommandHandler
{
    public function __construct(private readonly PatientInterface $patient) {}

    public function handle()
    {
        return $this->patient->all();
    }
}
