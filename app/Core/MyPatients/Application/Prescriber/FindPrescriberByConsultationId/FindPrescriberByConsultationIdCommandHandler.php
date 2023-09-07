<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;

class FindPrescriberByConsultationIdCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber) {}

    public function handle(FindPrescriberByConsultationIdCommand $command)
    {
        return $this->prescriber->findConsultationById($command->consultationId());
    }
}

