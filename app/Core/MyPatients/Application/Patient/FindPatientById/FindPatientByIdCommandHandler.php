<?php

namespace App\Core\MyPatients\Application\Patient\FindPatientById;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;


class FindPatientByIdCommandHandler
{
    public function __construct(private readonly PatientInterface $patient)
    {}

    public function handle(FindPatientByIdCommand $command)
    {
        return $this->patient->find($command->patientId());
    }


}
