<?php


namespace App\Core\MyPatients\Application\Speciality\FindSpecialityById;

class FindSpecialityByIdCommand
{
    private int $specialityId;

    public function __construct(int $id)
    {
        $this->specialityId = $id;
    }

    public function specialityId()
    {
        return $this->specialityId;
    }
}

