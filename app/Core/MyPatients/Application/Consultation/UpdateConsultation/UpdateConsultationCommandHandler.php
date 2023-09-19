<?php


namespace App\Core\MyPatients\Application\Consultation\UpdateConsultation;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;

class UpdateConsultationCommandHandler
{
    public function __construct(private readonly ConsultationInterface $consultation,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    /**
     * @throws ConsultationNotFoundException
     */
    public function handle(UpdateConsultationCommand $command): void
    {
        $this->consultationFinder->byIdOrFail($command->id());
        $this->consultation->update($command->consultation(), $command->id());
    }
}
