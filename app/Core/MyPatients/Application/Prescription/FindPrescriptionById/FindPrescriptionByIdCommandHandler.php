<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionById;

use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriptionByIdCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription)
    {}

    public function handle(FindPrescriptionByIdCommand $command)
    {
        return $this->prescription->find($command->id());
    }
}
