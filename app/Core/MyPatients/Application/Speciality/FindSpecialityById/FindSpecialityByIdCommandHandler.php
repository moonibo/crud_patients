<?php


namespace App\Core\MyPatients\Application\Speciality\FindSpecialityById;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;


class FindSpecialityByIdCommandHandler
{
    public function __construct(private readonly SpecialityInterface $speciality)
    {}

    public function handle(FindSpecialityByIdCommand $command)
    {

        return $this->speciality->find($command->specialityId());
    }
}
