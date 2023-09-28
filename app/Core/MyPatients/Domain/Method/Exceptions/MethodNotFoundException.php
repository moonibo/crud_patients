<?php


namespace App\Core\MyPatients\Domain\Method\Exceptions;

use Exception;

class MethodNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Method does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
