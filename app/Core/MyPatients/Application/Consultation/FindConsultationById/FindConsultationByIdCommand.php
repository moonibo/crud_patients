<?php


namespace App\Core\MyPatients\Application\Consultation\FindConsultationById;

class FindConsultationByIdCommand
{
    private int $consultationId;

    public function __construct(int $id)
    {
        $this->consultationId = $id;
    }

    public function consultationId()
    {
        return $this->consultationId;
    }
}
