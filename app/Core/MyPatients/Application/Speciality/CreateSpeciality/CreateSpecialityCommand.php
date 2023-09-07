<?php

namespace App\Core\MyPatients\Application\Speciality\CreateSpeciality;

class CreateSpecialityCommand
{
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
    }

    public function speciality()
    {
        return [
            'name' => $this->name,
        ];
    }
}
