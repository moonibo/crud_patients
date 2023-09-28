<?php

namespace App\Core\MyPatients\Application\Allergy\CreateAllergy;

class CreateAllergyCommand
{
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
    }

    public function allergy(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
