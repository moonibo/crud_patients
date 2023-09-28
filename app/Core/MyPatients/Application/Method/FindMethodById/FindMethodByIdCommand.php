<?php

namespace App\Core\MyPatients\Application\Method\FindMethodById;

class FindMethodByIdCommand
{
    private int $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function methodId(): int
    {
        return $this->id;
    }
}

