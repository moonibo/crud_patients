<?php

namespace App\Core\MyPatients\Application\Step\UpdateStep;

use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;
use App\Core\MyPatients\Domain\Method\Services\MethodFinder;
use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Core\MyPatients\Domain\Step\Services\StepFinder;

class UpdateStepCommandHandler
{
    public function __construct(private readonly StepFinder $stepFinder,
                               private readonly MethodFinder $methodFinder,
                                private readonly StepInterface $step){}

    /**
     * @throws StepNotFoundException
     * @throws MethodNotFoundException
     */
    public function handle(UpdateStepCommand $command): void
    {
        $this->stepFinder->byIdOrFail($command->stepId());
        $this->methodFinder->byIdOrFail($command->methodId());
        $this->step->update($command->step(), $command->stepId());
    }
}
