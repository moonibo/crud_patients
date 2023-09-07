<?php

namespace App\Core\MyPatients\Application\Consultation\CreateConsultation;

class CreateConsultationCommand
{
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
    }

    public function consultation(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
