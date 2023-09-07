<?php


namespace App\Core\MyPatients\Application\Patient\DeletePatient;

class DeletePatientCommand
{
    private int $patientId;

    public function __construct(int $id)
    {
        $this->patientId = $id;
    }

    public function patientId()
    {
        return $this->patientId;
    }
}
