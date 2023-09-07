<?php

namespace App\Core\MyPatients\Application\Prescription\FindAllPrescriptions;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;

class FindAllPrescriptionsCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription){}

    public function handle()
    {
        return $this->prescription->all();
    }
}
