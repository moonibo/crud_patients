<?php

namespace App\Core\MyPatients\Domain\Record\Exceptions;

use Exception;

class RecordNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Record does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
