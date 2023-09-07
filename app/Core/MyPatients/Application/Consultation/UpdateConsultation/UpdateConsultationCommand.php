<?php

namespace App\Core\MyPatients\Application\Consultation\UpdateConsultation;

class UpdateConsultationCommand
{
    private int $id;
    private string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function id()
    {
        return $this->id;
    }

    public function consultation()
    {
        return [
            'name' => $this->name
        ];
    }
}
