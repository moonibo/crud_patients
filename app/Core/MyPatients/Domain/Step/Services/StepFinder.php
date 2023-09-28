<?php

namespace App\Core\MyPatients\Domain\Step\Services;




use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;

class StepFinder
{
    public function __construct(private readonly StepInterface $step)
    {
    }

    /**
     * @throws StepNotFoundException
     */
    public function exists(int $id): void
    {
        $exists = $this->step->exists($id);
        if (!$exists) {
            throw new StepNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->step->all();
    }

    public function byId(int $id)
    {
        return $this->step->find($id);
    }

    /**
     * @throws StepNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $step = $this->byId($id);
        if ($step == null) {
            throw new StepNotFoundException();
        }
    }

    public function byMethodId(int $method_id)
    {
        return $this->step->findByMethodId($method_id);
    }

    public function byMethodIdOrFail(int $method_id): void
    {
        $step = $this->byMethodId($method_id);
        if ($step == null) {
            throw new StepNotFoundException();
        }

    }
}
