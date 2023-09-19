<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberBySpecialityId;

use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;

class FindPrescriberBySpecialityIdCommandHandler
{
    public function __construct (private readonly PrescriberFinder $prescriberFinder){}

    /**
     * @throws PrescriberNotFoundException
     */
    public function handle(FindPrescriberBySpecialityIdCommand $command)
    {
        $this->prescriberFinder->bySpecialityIdOrFail($command->specialityId());
        return $this->prescriberFinder->bySpecialityId($command->specialityId());
    }
}
