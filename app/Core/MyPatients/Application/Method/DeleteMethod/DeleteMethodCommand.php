<?php

namespace App\Core\MyPatients\Application\Method\DeleteMethod;

class DeleteMethodCommand
{
    private int $methodId;
    public function __construct(int $id)
    {
        $this->methodId = $id;
    }

    public function methodId(): int
    {
        return $this->methodId;
    }
}
