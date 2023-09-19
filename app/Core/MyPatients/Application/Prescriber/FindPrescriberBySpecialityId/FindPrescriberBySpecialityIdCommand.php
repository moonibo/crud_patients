<?php


namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberBySpecialityId;

class FindPrescriberBySpecialityIdCommand
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
