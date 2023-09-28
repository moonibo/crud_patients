<?php

namespace App\Core\MyPatients\Application\Method\UpdateMethod;

class UpdateMethodCommand
{
    private int $id;
    private string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function methodId(): int
    {
        return $this->id;
    }

    public function method(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
