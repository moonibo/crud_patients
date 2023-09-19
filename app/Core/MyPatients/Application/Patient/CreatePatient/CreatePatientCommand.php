<?php
namespace App\Core\MyPatients\Application\Patient\CreatePatient;

class CreatePatientCommand
{

    private string $name;
    private string $surname;
    private string $mail;
    private string $gender;
    private mixed $prescriberId;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->mail = $data['mail'];
        $this->gender = $data['gender'];
        $this->prescriberId = $data['prescriber_id'];
    }

    public function prescriberId()
    {
        return $this->prescriberId;
    }

    public function gender()
    {
        return $this->gender;
    }

    public function patient(): array
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
