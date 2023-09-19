<?php

namespace App\Core\MyPatients\Application\Prescriber\CreatePrescriber;

class CreatePrescriberCommand
{
    private string $name;
    private int $speciality_id;
    private int $consultation_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->speciality_id = $data['speciality_id'];
        $this->consultation_id = $data['consultation_id'];
    }

    public function specialityId()
    {
        return $this->speciality_id;
    }

    public function consultationId()
    {
        return $this->consultation_id;
    }

    public function prescriber(): array
    {
        return [
            'name' => $this->name,
            'speciality_id' => $this->speciality_id,
            'consultation_id' => $this->consultation_id
        ];
    }
}
