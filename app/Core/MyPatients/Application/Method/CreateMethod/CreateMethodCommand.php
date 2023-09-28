<?php

namespace App\Core\MyPatients\Application\Method\CreateMethod;

class CreateMethodCommand
{
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
    }

    public function method(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
