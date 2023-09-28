<?php

namespace App\Core\MyPatients\Application\Pathology\DeletePathology;

use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;

class DeletePathologyCommandHandler
{
    public function __construct (private readonly PathologyFinder $pathologyFinder,
                                private readonly PathologyInterface $pathology){}

    /**
     * @throws PathologyNotFoundException
     */
    public function handle(DeletePathologyCommand $command): void
    {
        $this->pathologyFinder->byIdOrFail($command->pathologyId());
        $this->pathology->delete($command->pathologyId());
    }
}
