<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByConsultationId;

class FindPrescriptionByConsultationIdCommand
{
    private int $consultation_id;

    public function __construct(int $id)
    {
        $this->consultation_id = $id;
    }

    public function consultationId()
    {
        return $this->consultation_id;
    }
}
