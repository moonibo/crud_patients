<?php

namespace App\Core\MyPatients\Domain\RegisteredPrescriber\Services;

use App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts\RegisteredPrescriberInterface;
use App\Core\MyPatients\Domain\RegisteredPrescriber\Exceptions\PrescriberNotFoundException;

class RegisteredPrescriberFinder
{
    public function __construct(private readonly RegisteredPrescriberInterface $registeredPrescriber)
    {
    }

    public function exists(int $id): void
    {
        $exists = $this->registeredPrescriber->exists($id);
        if (!$exists) {
            throw new PrescriberNotFoundException();
        }
    }

    public function byId(int $id)
    {
        return $this->registeredPrescriber->find($id);
    }

    public function byMail(string $mail)
    {
        return $this->registeredPrescriber->findByMail($mail);
    }

    public function byIdOrFail(int $id): void
    {
        $prescriber = $this->byId($id);
        if ($prescriber == null) {
            throw new PrescriberNotFoundException();
        }
    }
}
