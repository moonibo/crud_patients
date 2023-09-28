<?php

namespace App\Core\MyPatients\Application\Step\DeleteStep;

use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Core\MyPatients\Domain\Step\Services\StepFinder;

class DeleteStepCommandHandler
{
    public function __construct(private readonly StepFinder $stepFinder,
                                private readonly StepInterface $step){}

    /**
     * @throws StepNotFoundException
     */
    public function handle(DeleteStepCommand $command): void
    {
        $this->stepFinder->byIdOrFail($command->stepId());
        $this->step->delete($command->stepId());
    }
}
