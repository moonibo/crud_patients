<?php

namespace App\Core\MyPatients\Application\RegisteredPrescriber;

class RegisteredPrescriberCommand
{
    private int $prescriber_id;
    private string $name;
    private string $mail;
    private string $password;

    public function __construct(array $data)
    {
        $this->prescriber_id = $data['prescriber_id'];
        $this->name = $data['name'];
        $this->mail = $data['email'];
        $this->password = $data['password'];
    }

    public function prescriberId(): int
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
            'email' => $this->mail,
            'password' => $this->password
        ];
    }
}
