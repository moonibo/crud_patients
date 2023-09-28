<?php

namespace App\Core\MyPatients\Application\Method\FindAllMethods;

use App\Core\MyPatients\Domain\Method\Services\MethodFinder;

class FindAllMethodsCommandHandler
{
    public function __construct(private readonly MethodFinder $methodFinder)
    {
    }

    public function handle()
    {
        return $this->methodFinder->findAll();
    }
}
