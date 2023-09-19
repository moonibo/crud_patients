<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPrescriberId;

class FindPrescriptionByPrescriberIdCommand
{
    private int $prescriber_id;

    public function __construct(int $id)
    {
        $this->prescriber_id = $id;
    }

    public function prescriberId(): int
    {
        return $this->prescriber_id;
    }
}
