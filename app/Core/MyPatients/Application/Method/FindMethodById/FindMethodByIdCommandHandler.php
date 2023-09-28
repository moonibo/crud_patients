<?php

namespace App\Core\MyPatients\Application\Method\FindMethodById;

use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Method\Services\MethodFinder;

class FindMethodByIdCommandHandler
{
    public function __construct(private readonly MethodFinder $methodFinder){}

    /**
     * @throws MethodNotFoundException
     */
    public function handle(FindMethodByIdCommand $command)
    {
        $this->methodFinder->byIdOrFail($command->methodId());
        return $this->methodFinder->byId($command->methodId());
    }
}
