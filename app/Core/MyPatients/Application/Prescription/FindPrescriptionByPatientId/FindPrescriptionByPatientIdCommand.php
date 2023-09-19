<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByPatientId;

class FindPrescriptionByPatientIdCommand
{
    private int $patient_id;

    public function __construct(int $id)
    {
        $this->patient_id = $id;
    }

    public function patientId(): int
    {
        return $this->patient_id;
    }
}
