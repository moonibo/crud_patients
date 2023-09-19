<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId;

use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;

class FindPrescriberByConsultationIdCommandHandler
{
    public function __construct(private readonly PrescriberFinder $prescriberFinder) {}

    /**
     * @throws PrescriberNotFoundException
     */
    public function handle(FindPrescriberByConsultationIdCommand $command)
    {
        $this->prescriberFinder->byConsultationIdOrFail($command->consultationId());
        return $this->prescriberFinder->byConsultationId($command->consultationId());
    }
}

