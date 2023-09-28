<?php

namespace App\Core\MyPatients\Application\Pathology\FindPathologyById;

use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;

class FindPathologyByIdCommandHandler
{
    public function __construct (private readonly PathologyFinder $pathologyFinder){}

    /**
     * @throws PathologyNotFoundException
     */
    public function handle(FindPathologyByIdCommand $command)
    {
        $this->pathologyFinder->byIdOrFail($command->pathologyId());
        return $this->pathologyFinder->byId($command->pathologyId());
    }
}
