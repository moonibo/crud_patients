<?php

namespace App\Core\MyPatients\Application\Consultation\CreateConsultation;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;

class CreateConsultationCommandHandler
{
    public function __construct(private readonly ConsultationInterface $speciality)
    {}

    public function handle(CreateConsultationCommand $command)
    {
        $this->speciality->create($command->consultation());
    }
}
