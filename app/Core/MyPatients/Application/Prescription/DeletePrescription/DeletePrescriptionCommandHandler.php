<?php

namespace App\Core\MyPatients\Application\Prescription\DeletePrescription;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class DeletePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriptionFinder $prescriptionFinder) {}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(DeletePrescriptionCommand $command): void
    {
        $this->prescriptionFinder->byIdOrFail($command->id());
        $this->prescription->delete($command->id());
    }
}
