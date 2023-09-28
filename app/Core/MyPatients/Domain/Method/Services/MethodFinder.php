<?php

namespace App\Core\MyPatients\Domain\Method\Services;



use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;
use App\Core\MyPatients\Domain\Method\Exceptions\MethodNotFoundException;

class MethodFinder
{
    public function __construct(private readonly MethodInterface $method)
    {
    }

    /**
     * @throws MethodNotFoundException
     */
    public function exists(int $id): void
    {
        $exists = $this->method->exists($id);
        if (!$exists) {
            throw new MethodNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->method->all();
    }

    public function byId(int $id)
    {
        return $this->method->find($id);
    }

    /**
     * @throws MethodNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $method = $this->byId($id);
        if ($method == null) {
            throw new MethodNotFoundException();
        }
    }
}
