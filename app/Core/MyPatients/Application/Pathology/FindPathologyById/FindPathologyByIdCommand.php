<?php

namespace App\Core\MyPatients\Application\Pathology\FindPathologyById;

class FindPathologyByIdCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function pathologyId(): int
    {
        return $this->id;
    }
}
