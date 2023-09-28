<?php

namespace App\Core\MyPatients\Application\Pathology\CreatePathology;

use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;

class CreatePathologyCommandHandler
{
    public function __construct(private readonly PathologyInterface $pathology){}

    public function handle(CreatePathologyCommand $command): void
    {
        $this->pathology->create($command->pathology());
    }
}
