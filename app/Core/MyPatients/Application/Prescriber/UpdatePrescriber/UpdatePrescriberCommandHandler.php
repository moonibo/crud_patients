<?php

namespace App\Core\MyPatients\Application\Prescriber\UpdatePrescriber;

use App\Core\MyPatients\Application\Prescriber\UpdatePrescriber\UpdatePrescriberCommand;
use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class UpdatePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly SpecialityFinder $specialityFinder,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    public function handle(UpdatePrescriberCommand $command)
    {
        $this->prescriberFinder->byIdOrFail($command->id());
        $this->specialityFinder->byIdOrFail($command->specialityId());
        $this->consultationFinder->byIdOrFail($command->consultationId());

        $this->prescriber->update($command->prescriber(), $command->id());

    }
}
