<?php

namespace App\Core\MyPatients\Application\Prescriber\FindPrescriberById;

class FindPrescriberByIdCommand
{
    private int $prescriberId;

    public function __construct(int $id)
    {
        $this->prescriberId = $id;
    }

    public function prescriberId()
    {
        return $this->prescriberId;
    }
}
