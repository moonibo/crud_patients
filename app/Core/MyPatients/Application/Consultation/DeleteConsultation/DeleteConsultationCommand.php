<?php

namespace App\Core\MyPatients\Application\Consultation\DeleteConsultation;

class DeleteConsultationCommand
{
    private int $consultationId;
    public function __construct(int $id)
    {
        $this->consultationId = $id;
    }

    public function consultationId(): int
    {
        return $this->consultationId;
    }
}
