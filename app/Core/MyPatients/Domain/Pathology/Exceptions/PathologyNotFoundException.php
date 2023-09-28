<?php

namespace App\Core\MyPatients\Domain\Pathology\Exceptions;

use Exception;

class PathologyNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Pathology does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
