<?php

namespace App\Core\MyPatients\Domain\Consultation\Exceptions;

use Exception;

class ConsultationNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "Consultation does not exist";
        $this->code = 404;
    }

    public function render(): void
    {
        abort($this->code, $this->message);
    }
}
