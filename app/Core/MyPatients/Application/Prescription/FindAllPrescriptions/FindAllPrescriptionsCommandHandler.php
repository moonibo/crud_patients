<?php

namespace App\Core\MyPatients\Application\Prescription\FindAllPrescriptions;

use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class FindAllPrescriptionsCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder){}

    public function handle()
    {
        return $this->prescriptionFinder->findAll();
    }
}
