<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberById;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;


class FindPrescriberByIdCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber)
    {}

    public function handle(FindPrescriberByIdCommand $command)
    {
        return $this->prescriber->find($command->prescriberId());

    }

}
