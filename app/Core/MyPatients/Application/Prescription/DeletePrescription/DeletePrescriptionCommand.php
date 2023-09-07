<?php

namespace App\Core\MyPatients\Application\Prescription\DeletePrescription;

class DeletePrescriptionCommand
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
