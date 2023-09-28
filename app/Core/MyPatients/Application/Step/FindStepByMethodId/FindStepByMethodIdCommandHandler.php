<?php

namespace App\Core\MyPatients\Application\Step\FindStepByMethodId;

use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Core\MyPatients\Domain\Step\Services\StepFinder;

class FindStepByMethodIdCommandHandler
{
    public function __construct(private readonly StepFinder $stepFinder){}

    /**
     * @throws StepNotFoundException
     */
    public function handle(FindStepByMethodIdCommand $command)
    {
        $this->stepFinder->byMethodIdOrFail($command->methodId());
        return $this->stepFinder->byMethodId($command->methodId());
    }
}
