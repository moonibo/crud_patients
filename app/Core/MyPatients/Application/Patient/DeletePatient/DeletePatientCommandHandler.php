<?php

namespace App\Core\MyPatients\Application\Patient\DeletePatient;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;


class DeletePatientCommandHandler
{
    public function __construct(private readonly PatientInterface $patient)
    {}

    public function handle(DeletePatientCommand $command)
    {
        if ($this->patient->find($command->patientId()) !== null) {
            return $this->patient->delete($command->patientId());
        } else {
            return false;
        }
    }

}
