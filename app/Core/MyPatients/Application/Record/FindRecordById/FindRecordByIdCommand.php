<?php

namespace App\Core\MyPatients\Application\Record\FindRecordById;

class FindRecordByIdCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
