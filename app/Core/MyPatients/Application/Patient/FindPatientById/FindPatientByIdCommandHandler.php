<?php

namespace App\Core\MyPatients\Application\Patient\FindPatientById;

use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;


class FindPatientByIdCommandHandler
{
    public function __construct(private readonly PatientFinder $patientFinder)
    {}

    /**
     * @throws PatientNotFoundException
     */
    public function handle(FindPatientByIdCommand $command)
    {
        $this->patientFinder->byIdOrFail($command->patientId());
        return $this->patientFinder->byId($command->patientId());
    }


}
