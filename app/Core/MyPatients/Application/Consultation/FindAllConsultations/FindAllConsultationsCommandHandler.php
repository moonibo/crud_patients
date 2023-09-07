<?php

namespace App\Core\MyPatients\Application\Consultation\FindAllConsultations;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;

class FindAllConsultationsCommandHandler
{
    public function __construct(private readonly ConsultationInterface $consultation)
    {
    }

    public function handle()
    {
        return $this->consultation->all();
    }
}
