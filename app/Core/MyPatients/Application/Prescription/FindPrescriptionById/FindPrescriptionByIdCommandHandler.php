<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionById;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByIdCommandHandler
{
    public function __construct(private readonly PrescriptionFinder $prescriptionFinder)
    {}

    /**
     * @throws PrescriptionNotFoundException
     */
    public function handle(FindPrescriptionByIdCommand $command)
    {
        $this->prescriptionFinder->byIdOrFail($command->id());
        return $this->prescriptionFinder->byId($command->id());
    }
}
