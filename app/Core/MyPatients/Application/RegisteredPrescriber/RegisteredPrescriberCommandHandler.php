<?php

namespace App\Core\MyPatients\Application\RegisteredPrescriber;

use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts\RegisteredPrescriberInterface;
use App\Core\MyPatients\Domain\RegisteredPrescriber\Services\RegisteredPrescriberFinder;

class RegisteredPrescriberCommandHandler
{
    public function __construct(private readonly PrescriberFinder $prescriberFinder,
                                private readonly RegisteredPrescriberFinder $registeredPrescriberFinder,
                                private readonly RegisteredPrescriberInterface $registeredPrescriber)
    {}

    public function handle(RegisteredPrescriberCommand $command)
    {
        return $this->registeredPrescriber->create($command->registeredPrescriber());
    }

    public function findPrescriberById(int $id)
    {
        return $this->prescriberFinder->byId($id);
    }

    public function findRegisteredPrescriberByMail(string $mail)
    {
        return $this->registeredPrescriberFinder->byMail($mail);
    }
}
