<?php

namespace App\Core\MyPatients\Application\Step\CreateStep;

use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Method\Services\MethodFinder;
use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;

class CreateStepCommandHandler
{
    public function __construct(private readonly MethodFinder $methodFinder,
                                private readonly StepInterface $step)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function handle(CreateStepCommand $command): void
    {
        $this->methodFinder->byIdOrFail($command->methodId());
        $this->step->create($command->step());
    }
}
