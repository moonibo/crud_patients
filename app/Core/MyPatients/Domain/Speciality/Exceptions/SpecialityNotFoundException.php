<?php

namespace App\Core\MyPatients\Domain\Speciality\Exceptions;

use Exception;

class SpecialityNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Speciality does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
