<?php

namespace App\Core\MyPatients\Domain\RegisteredPrescriber\Exceptions;

use Exception;

class RegisteredPrescriberNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Registered prescriber does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
