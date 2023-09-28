<?php

namespace App\Core\MyPatients\Application\Record\CreateRecord;

class CreateRecordCommand
{
    private int $prescriber_id;
    private int $patient_id;
    private array $allergies;
    private array $pathologies;
    private string $start_date;
    private string $end_date;

    public function __construct(array $data)
    {
        $this->prescriber_id = $data['prescriber_id'];
        $this->patient_id = $data['patient_id'];
        $this->allergies = $data['allergies'];
        $this->pathologies = $data['pathologies'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }

    public function prescriberId(): int
    {
        return $this->prescriber_id;
    }

    public function patientId(): int
    {
        return $this->patient_id;
    }

    public function allergies()
    {
        return $this->allergies;
    }

    public function pathologies()
    {
        return $this->pathologies;
    }

    public function record(): array
    {
        return [
            'prescriber_id' => $this->prescriber_id,
            'patient_id' => $this->patient_id,
            'allergies'=> $this->allergies,
            'pathologies' => $this->pathologies,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
