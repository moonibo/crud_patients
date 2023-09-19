<?php

namespace App\Core\MyPatients\Application\Patient\FindPatientByPrescriberId;

use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;


class FindPatientByPrescriberIdCommandHandler
{
    public function __construct(private readonly PatientFinder $patientFinder)
    {}

    /**
     * @throws PatientNotFoundException
     */
    public function handle(FindPatientByPrescriberIdCommand $command)
    {
        $this->patientFinder->byPrescriberIdOrFail($command->prescriberId());
        return $this->patientFinder->byPrescriberId($command->prescriberId());
    }

}
