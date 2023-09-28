<?php

namespace App\Core\MyPatients\Application\Prescription\CreatePrescription;

class CreatePrescriptionCommand
{
    private int $prescriber_id;
    private int $patient_id;
    private int $consultation_id;
    private int $record_id;
    private int $step_id;
    private array $pathologies;
    private int $doses_per_day;
    private int $days;

    public function __construct(array $data)
    {
        $this->prescriber_id = $data['prescriber_id'];
        $this->patient_id = $data['patient_id'];
        $this->consultation_id = $data['consultation_id'];
        $this->record_id = $data['record_id'];
        $this->step_id = $data['step_id'];
        $this->pathologies = $data['pathologies'];
        $this->doses_per_day = $data['doses_per_day'];
        $this->days = $data['days'];
    }

    public function prescriberId(): int
    {
        return $this->prescriber_id;
    }

    public function patientId(): int
    {
        return $this->patient_id;
    }

    public function consultationId(): int
    {
        return $this->consultation_id;
    }

    public function recordId(): int
    {
        return $this->record_id;
    }

    public function stepId(): int
    {
        return $this->step_id;
    }

    public function pathologies()
    {
        return $this->pathologies;
    }

    public function prescription(): array
    {
        return [
            'prescriber_id' => $this->prescriber_id,
            'patient_id' => $this->patient_id,
            'consultation_id' => $this->consultation_id,
            'record_id' => $this->record_id,
            'step_id' => $this->step_id,
            'pathologies' => $this->pathologies,
            'doses_per_day' => $this->doses_per_day,
            'days' => $this->days
        ];
    }
}
