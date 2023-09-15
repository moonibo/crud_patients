<?php

namespace App\Core\MyPatients\Application\Patient\UpdatePatient;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use Symfony\Component\HttpFoundation\Response;

class UpdatePatientCommandHandler
{
    public function __construct(private readonly PatientInterface $patient,
                               private readonly PatientFinder $patientFinder,
                               private readonly PrescriberFinder $prescriberFinder)
    {}

    /**
     * @throws PatientNotFoundException|PrescriberNotFoundException
     */
    public function handle (UpdatePatientCommand $command): void
    {
        $this->patientFinder->byIdOrFail($command->id());
        $this->prescriberFinder->byIdOrFail($command->prescriberId());

        if($command->prescriberId() !== null && $this->prescriberFinder->byId($command->prescriberId()) !== null) {
            $this->patient->update([...$command->patient(),'gender' => $this->transformGender($command->gender()), 'prescriber_id' => $command->prescriberId()], $command->id());
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
