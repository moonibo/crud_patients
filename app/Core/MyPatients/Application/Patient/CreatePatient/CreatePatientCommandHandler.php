<?php

namespace App\Core\MyPatients\Application\Patient\CreatePatient;

use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;


class CreatePatientCommandHandler
{
    public function __construct(private readonly PatientInterface $patient,
                                private readonly PrescriberFinder $prescriberFinder)
        {}

    /**
     * @throws PrescriberNotFoundException
     */
    public function handle(CreatePatientCommand $command)
    {
        if ($command->prescriberId() !== null) {
            $this->prescriberFinder->byIdOrFail($command->prescriberId());
            return $this->patient->create([...$command->patient(),'gender' => $this->transformGender($command->gender()), 'prescriber_id' => $command->prescriberId()]);
        }
        return $this->patient->create([...$command->patient(),'gender' => $this->transformGender($command->gender())]);
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
