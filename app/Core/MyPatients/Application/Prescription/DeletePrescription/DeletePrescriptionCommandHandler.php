<?php

namespace App\Core\MyPatients\Application\Prescription\DeletePrescription;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class DeletePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription) {}

    public function handle(DeletePrescriptionCommand $command)
    {
        return $this->prescription->delete($command->id());
    }
}
