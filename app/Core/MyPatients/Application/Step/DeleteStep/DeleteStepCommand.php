<?php

namespace App\Core\MyPatients\Application\Step\DeleteStep;

class DeleteStepCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function stepId(): int
    {
        return $this->id;
    }
}
