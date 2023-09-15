<?php

namespace App\Core\MyPatients\Application\RegisteredPrescriber;

class RegisteredPrescriberCommand
{
    private $prescriber_id;
    private $name;
    private $mail;
    private $password;

    public function __construct(array $data)
    {
        $this->prescriber_id = $data['prescriber_id'];
        $this->name = $data['name'];
        $this->mail = $data['mail'];
        $this->password = $data['password'];
    }

    public function prescriberId()
    {
        return $this->prescriber_id;
    }

    public function password()
    {
        return $this->password;
    }

    public function mail()
    {
        return $this->mail;
    }

    public function registeredPrescriber(): array
    {
        return [
            'prescriber_id' => $this->prescriber_id,
            'name' => $this->name,
            'mail' => $this->mail,
            'password' => $this->password
        ];
    }
}
