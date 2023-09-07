<?php

namespace App\Core\MyPatients\Application\Patient\FindPatientByPrescriberId;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;


class FindPatientByPrescriberIdCommandHandler
{
    public function __construct(private readonly PatientInterface $patient)
    {}

    public function handle(FindPatientByPrescriberIdCommand $command)
    {
        return $this->patient->findPrescriberById($command->prescriberId());
    }

}
