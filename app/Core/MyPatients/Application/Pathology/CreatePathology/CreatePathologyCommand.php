<?php

namespace App\Core\MyPatients\Application\Pathology\CreatePathology;

class CreatePathologyCommand
{
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
    }

    public function pathology(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
