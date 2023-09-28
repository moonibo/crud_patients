<?php

namespace App\Core\MyPatients\Application\Step\FindStepById;


use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Core\MyPatients\Domain\Step\Services\StepFinder;

class FindStepByIdCommandHandler
{
    public function __construct(private readonly StepFinder $stepFinder){}

    /**
     * @throws StepNotFoundException
     */
    public function handle(FindStepByIdCommand $command)
    {
        $this->stepFinder->byIdOrFail($command->stepId());
        return $this->stepFinder->byId($command->stepId());
    }
}
