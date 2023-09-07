<?php


namespace App\Core\MyPatients\Application\Consultation\UpdateConsultation;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;

class UpdateConsultationCommandHandler
{
    public function __construct(private readonly ConsultationInterface $consultation)
    {}

    public function handle(UpdateConsultationCommand $command)
    {
        if ($this->consultation->find($command->id()) !== null) {
            $this->consultation->update($command->consultation(), $command->id());
        }
    }
}
