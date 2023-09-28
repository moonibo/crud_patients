<?php

namespace App\Core\MyPatients\Domain\Pathology\Services;



use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;

class PathologyFinder
{
    public function __construct(private readonly PathologyInterface $pathology)
    {
    }

    /**
     * @throws PathologyNotFoundException
     */
    public function exists(int $id): void
    {
        $exists = $this->pathology->exists($id);
        if (!$exists) {
            throw new PathologyNotFoundException();
        }
    }

    public function findAll()
    {
        return $this->pathology->all();
    }

    public function byId(int $id)
    {
        return $this->pathology->find($id);
    }

    /**
     * @throws PathologyNotFoundException
     */
    public function byIdOrFail(int $id): void
    {
        $pathology = $this->byId($id);
        if ($pathology == null) {
            throw new PathologyNotFoundException();
        }
    }
}
