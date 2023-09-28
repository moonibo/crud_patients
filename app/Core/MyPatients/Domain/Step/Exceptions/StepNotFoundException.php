<?php


namespace App\Core\MyPatients\Domain\Step\Exceptions;

use Exception;

class StepNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Step does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
