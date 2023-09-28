<?php

namespace App\Core\MyPatients\Application\Allergy\UpdateAllergy;

class UpdateAllergyCommand
{
    private int $id;
    private string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function allergyId(): int
    {
        return $this->id;
    }

    public function allergy(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
