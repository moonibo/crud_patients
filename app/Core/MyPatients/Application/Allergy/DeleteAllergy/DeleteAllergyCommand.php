<?php

namespace App\Core\MyPatients\Application\Allergy\DeleteAllergy;

class DeleteAllergyCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function allergyId(): int
    {
        return $this->id;
    }
}
