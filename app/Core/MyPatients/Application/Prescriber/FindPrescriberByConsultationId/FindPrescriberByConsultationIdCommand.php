<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberByConsultationId;

class FindPrescriberByConsultationIdCommand
{
    private int $consultation_id;

    public function __construct(int $id)
    {
        $this->consultation_id = $id;
    }

    public function consultationId(): int
    {
        return $this->consultation_id;
    }
}
