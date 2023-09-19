<?php

namespace App\Core\MyPatients\Application\Patient\FindPatientByPrescriberId;

class FindPatientByPrescriberIdCommand
{
    private int $prescriberId;

    public function __construct(int $id)
    {
        $this->prescriberId = $id;
    }

    public function prescriberId(): int
    {
        return $this->prescriberId;
    }
}
