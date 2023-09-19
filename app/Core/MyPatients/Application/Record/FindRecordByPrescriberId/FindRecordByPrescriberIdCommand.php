<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPrescriberId;

class FindRecordByPrescriberIdCommand
{
    private int $prescriberId;
    public function __construct(int $prescriberId)
    {
        $this->prescriberId = $prescriberId;
    }

    public function prescriberId(): int
    {
        return $this->prescriberId;
    }

}
