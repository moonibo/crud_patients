<?php

namespace App\Core\MyPatients\Application\Patient\UpdatePatient;

class UpdatePatientCommand
{
    private int $id;
    private string $name;
    private string $surname;
    private string $mail;
    private string $gender;
    private mixed $prescriberId;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->mail = $data['mail'];
        $this->gender = $data['gender'];
        $this->prescriberId = $data['prescriber_id'];
    }

    public function id()
    {
        return $this->id;
    }

    public function prescriberId()
    {
        return $this->prescriberId;
    }

    public function gender()
    {
        return $this->gender;
    }

    public function patient()
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname ,
            'mail' => $this->mail,
            'gender' => $this->gender,
            'prescriber_id' => $this->prescriberId,
        ];
    }

}

