<?php

namespace App\Core\MyPatients\Application\Step\UpdateStep;

class UpdateStepCommand
{
    private int $id;
    private int $method_id;
    private string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->method_id = $data['method_id'];
        $this->name = $data['name'];
    }

    public function stepId(): int
    {
        return $this->id;
    }

    public function methodId(): int
    {
        return $this->method_id;
    }

    public function step(): array
    {
        return [
            'method_id' => $this->method_id,
            'name' => $this->name
        ];
    }
}
