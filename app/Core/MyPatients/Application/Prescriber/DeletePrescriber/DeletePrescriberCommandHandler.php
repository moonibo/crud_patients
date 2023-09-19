<?php

namespace App\Core\MyPatients\Application\Prescriber\DeletePrescriber;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;

class DeletePrescriberCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber,
                                private readonly PrescriberFinder $prescriberFinder)
    {
    }

    /**
     * @throws PrescriberNotFoundException
     */
    public function handle(DeletePrescriberCommand $command): void
    {
        $this->prescriberFinder->byIdOrFail($command->id());
        $this->prescriber->delete($command->id());
    }
}
