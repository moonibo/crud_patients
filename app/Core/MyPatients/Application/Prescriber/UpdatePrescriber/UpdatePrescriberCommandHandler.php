<?php

namespace App\Core\MyPatients\Application\Prescriber\UpdatePrescriber;

use App\Core\MyPatients\Application\Prescriber\UpdatePrescriber\UpdatePrescriberCommand;
use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;

class UpdatePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly SpecialityInterface $speciality,
                                private readonly ConsultationInterface $consultation)
    {}

    public function handle(UpdatePrescriberCommand $command)
    {

        if ($this->prescriber->find($command->id()) !== null) {
            if ($this->speciality->find($command->specialityId()) !== null && $this->consultation->find($command->consultationId()) !== null) {
                $this->prescriber->update($command->prescriber(), $command->id());
            }
        }
    }
}
