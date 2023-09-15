<?php

namespace App\Core\MyPatients\Application\Prescriber\CreatePrescriber;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class CreatePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly SpecialityInterface $speciality,
                                private readonly ConsultationInterface $consultation,
                                private readonly SpecialityFinder $specialityFinder,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    public function handle(CreatePrescriberCommand $command)
    {
        $this->specialityFinder->byIdOrFail($command->specialityId());
        $this->consultationFinder->byIdOrFail($command->consultationId());
        $this->prescriber->create($command->prescriber());
    }

}
