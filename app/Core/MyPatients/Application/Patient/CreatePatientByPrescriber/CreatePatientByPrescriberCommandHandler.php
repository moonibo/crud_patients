<?php

namespace App\Core\MyPatients\Application\Patient\CreatePatientByPrescriber;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;

class CreatePatientByPrescriberCommandHandler
{
    public function __construct(private readonly PatientInterface $patient)
    {

    }

    public function handle (CreatePatientByPrescriberCommand $command): void
    {
        $this->patient->create([...$command->patient(), 'gender' => $this->transformGender($command->gender())]);
    }

    public function transformGender(string $gender)
    {
        switch($gender) {
            case 'H':
                return 0;
            case 'M':
                return 1;
        }
    }
}
