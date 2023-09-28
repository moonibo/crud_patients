<?php

namespace App\Core\MyPatients\Application\Step\FindStepByMethodId;

class FindStepByMethodIdCommand
{
    private int $method_id;

    public function __construct(int $method_id)
    {
        $this->method_id = $method_id;
    }

    public function methodId(): int
    {
        return $this->method_id;
    }
}
