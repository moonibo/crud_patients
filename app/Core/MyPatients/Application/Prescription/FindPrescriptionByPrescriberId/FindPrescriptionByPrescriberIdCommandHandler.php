<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPrescriberId;

use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;

class FindPrescriptionByPrescriberIdCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder){}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(FindPrescriptionByPrescriberIdCommand $command)
    {
        $this->prescriptionFinder->byPrescriberIdOrFail($command->prescriberId());
        return $this->prescriptionFinder->byPrescriberId($command->prescriberId());
    }
}
