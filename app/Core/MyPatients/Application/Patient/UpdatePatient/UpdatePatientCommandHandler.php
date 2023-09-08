<?php

namespace App\Core\MyPatients\Application\Patient\UpdatePatient;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use Symfony\Component\HttpFoundation\Response;

class UpdatePatientCommandHandler
{
    public function __construct(private readonly PatientInterface $patient,
                               private readonly PrescriberInterface $prescriber)
    {}

    public function handle (UpdatePatientCommand $command)
    {
        if (is_null($this->patient->find($command->id()))) {
            return false;
        }

        if ($command->prescriberId() !== null && $this->prescriber->find($command->prescriberId()) === null) {
            return false;
        }

        if($command->prescriberId() !== null && $this->prescriber->find($command->prescriberId()) !== null) {
            $this->patient->update([...$command->patient(),'gender' => $this->transformGender($command->gender()), 'prescriber_id' => $prescriber_id], $command->id());
        }

        $this->patient->update([...$command->patient(),'gender' => $this->transformGender($command->gender())], $command->id());

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
