<?php

namespace App\Core\MyPatients\Application\Method\DeleteMethod;

use App\Core\MyPatients\Application\Method\FindMethodById\FindMethodByIdCommand;
use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Method\Services\MethodFinder;

class DeleteMethodCommandHandler
{
    public function __construct(private readonly MethodFinder $methodFinder,
                                private readonly MethodInterface $method){}

    /**
     * @throws MethodNotFoundException
     */
    public function handle(FindMethodByIdCommand $command): void
    {
        $this->methodFinder->byIdOrFail($command->methodId());
        $this->method->delete($command->methodId());
    }
}
