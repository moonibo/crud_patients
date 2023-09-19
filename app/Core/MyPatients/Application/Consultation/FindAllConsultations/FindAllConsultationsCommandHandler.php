<?php

namespace App\Core\MyPatients\Application\Consultation\FindAllConsultations;

use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;

class FindAllConsultationsCommandHandler
{
    public function __construct(private readonly ConsultationFinder $consultationFinder)
    {
    }

    public function handle()
    {
        return $this->consultationFinder->findAll();
    }
}
