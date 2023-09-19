<?php

namespace App\Core\MyPatients\Application\Speciality\DeleteSpeciality;

class DeleteSpecialityCommand
{
    private int $specialityId;
    public function __construct(int $id)
    {
      $this->specialityId = $id;
    }

    public function specialityId(): int
    {
        return $this->specialityId;
    }
}
