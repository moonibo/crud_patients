<?php

namespace App\Core\MyPatients\Application\Pathology\FindAllPathologies;

use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;

class FindAllPathologiesCommandHandler
{
    public function __construct(private readonly PathologyFinder $pathologyFinder){}

    public function handle()
    {
        return $this->pathologyFinder->findAll();
    }
}
