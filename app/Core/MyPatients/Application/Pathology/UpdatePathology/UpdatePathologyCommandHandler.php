<?php

namespace App\Core\MyPatients\Application\Pathology\UpdatePathology;

use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;

class UpdatePathologyCommandHandler
{
    public function __construct(private readonly PathologyFinder $pathologyFinder,
                                private readonly PathologyInterface $pathology) {}

    /**
     * @throws PathologyNotFoundException
     */
    public function handle(UpdatePathologyCommand $command): void
    {
        $this->pathologyFinder->byIdOrFail($command->pathologyId());
        $this->pathology->update($command->pathology(), $command->pathologyId());
    }
}
