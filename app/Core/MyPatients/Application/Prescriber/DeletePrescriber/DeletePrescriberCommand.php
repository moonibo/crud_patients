<?php

namespace App\Core\MyPatients\Application\Prescriber\DeletePrescriber;

class DeletePrescriberCommand
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
