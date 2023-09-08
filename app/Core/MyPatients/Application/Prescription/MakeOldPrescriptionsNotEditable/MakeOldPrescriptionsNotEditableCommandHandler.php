<?php

namespace App\Core\MyPatients\Application\Prescription\MakeOldPrescriptionsNotEditable;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class MakeOldPrescriptionsNotEditableCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription)
    {}

    public function handle(): void
    {
        $prescriptions = $this->prescription->updatedOlderThanFifteenMinutes();
        $ids = [];
        if ($prescriptions) {
            foreach($prescriptions as $prescription) {
                $ids[] = $prescription->id;
            }
            $this->prescription->setEditableToFalse($ids);
        }

    }
}
