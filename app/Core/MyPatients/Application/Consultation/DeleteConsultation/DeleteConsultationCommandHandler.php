<?php

namespace App\Core\MyPatients\Application\Consultation\DeleteConsultation;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;

class DeleteConsultationCommandHandler {

    public function __construct (private readonly ConsultationInterface $consultation,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    /**
     * @throws ConsultationNotFoundException
     */
    public function handle(DeleteConsultationCommand $command): void
    {
        $this->consultationFinder->byIdOrFail($command->consultationId());
        $this->consultation->delete($command->consultationId());

    }
}

