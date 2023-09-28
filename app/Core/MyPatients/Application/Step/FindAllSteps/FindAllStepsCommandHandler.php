<?php

namespace App\Core\MyPatients\Application\Step\FindAllSteps;

use App\Core\MyPatients\Domain\Step\Services\StepFinder;

class FindAllStepsCommandHandler
{
    public function __construct(private readonly StepFinder $stepFinder)
    {
    }

    public function handle()
    {
        return $this->stepFinder->findAll();
    }
}
