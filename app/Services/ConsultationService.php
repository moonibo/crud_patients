<?php

namespace App\Services;

class ConsultationService
{
    public function __construct(private readonly ConsultationInterface $consultation)
    {
    }

    public function index()
    {
        return $this->consultation->all();
    }

    public function show (int $id)
    {
        return $this->consultation->find($id);
    }

    public function store (array $attributes)
    {
        return $this->consultation->create($attributes);
    }

    public function update (array $attributes, int $id)
    {
        return $this->consultation->update($attributes, $id);
    }

    public function delete (int $id)
    {
        return $this->consultation->delete($id);
    }
}
