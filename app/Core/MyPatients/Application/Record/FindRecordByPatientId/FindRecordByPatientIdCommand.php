<?php

namespace App\Core\MyPatients\Application\Record\FindRecordByPatientId;

class FindRecordByPatientIdCommand
{
    private int $patientId;

    public function __construct(int $patientId)
    {
        $this->patientId = $patientId;
    }

    public function patientId(): int
    {
        return $this->patientId;
    }
}
