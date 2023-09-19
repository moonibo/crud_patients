<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientAndPrescriberId;

class FindRecordByPatientAndPrescriberIdCommand
{
    private int $patientId;
    private int $prescriberId;

    public function __construct(int $patientId, int $prescriberId)
    {
        $this->patientId = $patientId;
        $this->prescriberId = $prescriberId;
    }

    public function patientId(): int
    {
        return $this->patientId;
    }

    public function prescriberId(): int
    {
        return $this->prescriberId;
    }
}
