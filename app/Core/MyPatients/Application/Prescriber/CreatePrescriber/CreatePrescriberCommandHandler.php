<?php

namespace App\Core\MyPatients\Application\Prescriber\CreatePrescriber;

use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Speciality\Exceptions\SpecialityNotFoundException;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;

class CreatePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly SpecialityFinder $specialityFinder,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    /**
     * @throws ConsultationNotFoundException
     * @throws SpecialityNotFoundException
     */
    public function handle(CreatePrescriberCommand $command): void
    {
        $this->specialityFinder->byIdOrFail($command->specialityId());
        $this->consultationFinder->byIdOrFail($command->consultationId());
        $this->prescriber->create($command->prescriber());
    }

}
