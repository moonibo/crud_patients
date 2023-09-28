<?php

namespace App\Core\MyPatients\Domain\Allergy\Exceptions;

use Exception;

class AllergyNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Allergy does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
