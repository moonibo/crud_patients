<?php

namespace App\Core\MyPatients\Application\Step\CreateStep;

class CreateStepCommand
{
    private int $method_id;
    private string $name;

    public function __construct(array $data)
    {
        $this->method_id = $data['method_id'];
        $this->name = $data['name'];
    }

    public function methodId(): int
    {
        return $this->method_id;
    }

    public function step(): array
    {
        return [
            'method_id' => $this->method_id,
            'name' => $this->name,
        ];
    }
}
