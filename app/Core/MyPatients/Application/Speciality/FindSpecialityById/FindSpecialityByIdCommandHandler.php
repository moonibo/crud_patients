<?php


namespace App\Core\MyPatients\Application\Speciality\FindSpecialityById;

use App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface;
use App\Core\MyPatients\Domain\Speciality\Exceptions\SpecialityNotFoundException;
use App\Core\MyPatients\Domain\Speciality\Services\SpecialityFinder;


class FindSpecialityByIdCommandHandler
{
    public function __construct(private readonly SpecialityFinder $specialityFinder)
    {}

    /**
     * @throws SpecialityNotFoundException
     */
    public function handle(FindSpecialityByIdCommand $command)
    {
        $this->specialityFinder->byIdOrFail($command->specialityId());
        return $this->specialityFinder->byId($command->specialityId());
    }
}
