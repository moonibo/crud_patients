<?php

namespace App\Core\MyPatients\Application\Pathology\UpdatePathology;

class UpdatePathologyCommand
{
    private int $id;
    private string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function pathologyId(): int
    {
        return $this->id;
    }

    public function pathology(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
