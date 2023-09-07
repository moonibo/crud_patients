<?php

namespace App\Core\MyPatients\Application\Prescriber\FindAllPrescribers;

use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;

class FindAllPrescribersCommandHandler
{
    public function __construct(private readonly PrescriberInterface $prescriber){}

    public function handle()
    {
        return $this->prescriber->all();
    }
}
