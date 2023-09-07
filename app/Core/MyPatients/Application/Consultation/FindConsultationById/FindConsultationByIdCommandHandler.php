<?php


namespace App\Core\MyPatients\Application\Consultation\FindConsultationById;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;


class FindConsultationByIdCommandHandler
{
    public function __construct(private readonly ConsultationInterface $consultation)
    {}

    public function handle(FindConsultationByIdCommand $command)
    {

        return $this->consultation->find($command->consultationId());
    }
}
