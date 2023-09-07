<?php

class CreatePatientByPrescriberCommand
{
    private string $firstName;

    public function __construct(array $data)
    {
        $this->firstName = $data['first_name'];
    }

    public function firstName()
    {
        return $this->firstName;
    }
}
