<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPrescriberId;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class FindPrescriptionByPrescriberIdCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription){}

    public function handle(FindPrescriptionByPrescriberIdCommand $command)
    {
        return $this->prescription->findByPrescriberId($command->prescriberId());
    }
}
