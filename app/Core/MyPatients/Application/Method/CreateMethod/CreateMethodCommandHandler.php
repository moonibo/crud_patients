<?php

namespace App\Core\MyPatients\Application\Method\CreateMethod;

use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;

class CreateMethodCommandHandler
{
    public function __construct(private readonly MethodInterface $method)
    {
    }

    public function handle(CreateMethodCommand $command): void
    {
        $this->method->create($command->method());
    }
}
