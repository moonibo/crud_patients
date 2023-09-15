<?php

namespace App\Core\MyPatients\Domain\Prescriber\Exceptions;

use Exception;

class PrescriberNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Prescriber does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
