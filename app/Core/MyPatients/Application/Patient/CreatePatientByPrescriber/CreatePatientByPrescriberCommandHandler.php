<?php

class CreatePatientByPrescriberCommandHandler
{
    public function __construct(private \App\Services\PatientInterface $patient)
    {

    }

    public function handle (CreatePatientByPrescriberCommand $command)
    {
        $this->patient->create($command->patient());
    }
}
