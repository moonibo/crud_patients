<?php

namespace App\Core\MyPatients\Application\Prescriber\DeletePrescriber;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;

class DeletePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber)
    {
    }

    public function handle(DeletePrescriberCommand $command)
    {
        if ($this->prescriber->find($command->id()) !== null) {
            return $this->prescriber->delete($command->id());
        } else {
            return false;
        }
    }
}
