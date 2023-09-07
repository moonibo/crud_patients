<?php

namespace App\Core\MyPatients\Application\Record\CreateRecord;

class CreateRecordCommand
{
    private int $prescriber_id;
    private int $patient_id;
    private string $start_date;
    private string $end_date;

    public function __construct(array $data)
    {
        $this->prescriber_id = $data['prescriber_id'];
        $this->patient_id = $data['patient_id'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }

    public function prescriberId()
    {
        return $this->prescriber_id;
    }

    public function patientId()
    {
        return $this->patient_id;
    }

    public function record()
    {
        return [
            'prescriber_id' => $this->prescriber_id,
            'patient_id' => $this->patient_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
