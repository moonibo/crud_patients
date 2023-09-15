<?php

namespace App\Core\MyPatients\Domain\Patient\Exceptions;

use Exception;

class PatientNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Patient does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
