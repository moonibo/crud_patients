<?php


namespace App\Core\MyPatients\Application\Speciality\UpdateSpeciality;

class UpdateSpecialityCommand
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

    public function speciality()
    {
        return [
            'name' => $this->name
        ];
    }
}
