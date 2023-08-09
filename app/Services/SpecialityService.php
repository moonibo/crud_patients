<?php

namespace App\Services;

class SpecialityService
{
    public function __construct(
        private readonly SpecialityInterface $speciality
    ) {
    }

    public function index()
    {
        return $this->speciality->all();
    }

    public function show(int $id)
    {
        return $this->speciality->find($id);
    }

    public function store(array $attributes)
    {
        return $this->speciality->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->speciality->update($attributes, $id);
    }

    public function delete(int $id)
    {
        return $this->speciality->delete($id);
    }

}
