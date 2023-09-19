<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberById;

use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;


class FindPrescriberByIdCommandHandler
{
    public function __construct(private readonly PrescriberFinder $prescriberFinder)
    {}

    /**
     * @throws PrescriberNotFoundException
     */
    public function handle(FindPrescriberByIdCommand $command)
    {
        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        return $this->prescriberFinder->byId($command->prescriberId());
    }

}
