<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionById;

class FindPrescriptionByIdCommand
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
