<?php

namespace App\Core\MyPatients\Domain\Prescription\Exceptions;

use Exception;

class PrescriptionNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Prescription does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
