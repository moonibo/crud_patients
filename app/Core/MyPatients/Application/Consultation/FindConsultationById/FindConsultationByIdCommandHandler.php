<?php


namespace App\Core\MyPatients\Application\Consultation\FindConsultationById;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;


class FindConsultationByIdCommandHandler
{
    public function __construct(private readonly ConsultationInterface $consultation,
                                private readonly ConsultationFinder $consultationFinder)
    {}

    /**
     * @throws ConsultationNotFoundException
     */
    public function handle(FindConsultationByIdCommand $command)
    {
        $this->consultationFinder->byIdOrFail($command->consultationId());
        return $this->consultation->find($command->consultationId());
    }
}
