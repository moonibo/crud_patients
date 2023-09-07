<?php

namespace App\Core\MyPatients\Application\Prescriber\CreatePrescriber;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class CreatePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly SpecialityInterface $speciality,
                                private readonly ConsultationInterface $consultation)
    {}

    public function handle(CreatePrescriberCommand $command)
    {
        if($this->speciality->find($command->specialityId()) !== null && $this->consultation->find($command->consultationId()) !== null) {
            $this->prescriber->create($command->prescriber());
        }
    }

}
