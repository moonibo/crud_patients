<?php

namespace App\Core\MyPatients\Application\Patient\DeletePatient;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;


class DeletePatientCommandHandler
{
    public function __construct(private readonly PatientInterface $patient,
                                private readonly PatientFinder $patientFinder)
    {}

    /**
     * @throws PatientNotFoundException
     */
    public function handle(DeletePatientCommand $command): void
    {
        $this->patientFinder->byIdOrFail($command->patientId());
        $this->patient->delete($command->patientId());
    }

}
