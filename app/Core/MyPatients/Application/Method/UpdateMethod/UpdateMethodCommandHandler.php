<?php

namespace App\Core\MyPatients\Application\Method\UpdateMethod;

use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Method\Services\MethodFinder;

class UpdateMethodCommandHandler
{
    public function __construct(private readonly MethodInterface $method,
                                private readonly MethodFinder $methodFinder)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function handle(UpdateMethodCommand $command): void
    {
        $this->methodFinder->byIdOrFail($command->methodId());
        $this->method->update($command->method(), $command->methodId());
    }
}
