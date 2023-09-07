<?php

namespace App\Core\MyPatients\Application\Consultation\DeleteConsultation;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;

class DeleteConsultationCommandHandler {

    public function __construct (private readonly ConsultationInterface $consultation)
    {}

    public function handle(DeleteConsultationCommand $command)
    {

        if ($this->consultation->find($command->consultationId()) !== null) {
            return $this->consultation->delete($command->consultationId());
        } else {
            return false;
        }
    }
}

