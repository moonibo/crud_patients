<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberBySpecialityId;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;

class FindPrescriberBySpecialityIdCommandHandler
{
    public function __construct (private readonly PrescriberInterface $prescriber){}

    public function handle(FindPrescriberBySpecialityIdCommand $command)
    {
        return $this->prescriber->findSpecialityById($command->specialityId());
    }
}
