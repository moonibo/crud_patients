<?php

namespace App\Core\MyPatients\Application\Prescriber\FindAllPrescribers;

use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;

class FindAllPrescribersCommandHandler
{
    public function __construct(private readonly PrescriberFinder $prescriberFinder){}

    public function handle()
    {
        return $this->prescriberFinder->findAll();
    }
}
