<?php

namespace App\Core\MyPatients\Application\Prescription\UpdatePrescription;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use Symfony\Component\HttpFoundation\Response;

class UpdatePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient,
                                private readonly ConsultationInterface $consultation,
                                private readonly RecordInterface $record){}

    public function handle(UpdatePrescriptionCommand $command)
    {
        if ($this->prescription->find($command->id())) {
            if (is_null($this->prescriber->find($command->prescriberId()))) {
                return false;
            }

            if(is_null($this->patient->find($command->patientId()))) {
                return false;
            }

            if (is_null($this->consultation->find($command->consultationId()))) {
                return false;
            }

            if (is_null($this->record->find($command->recordId()))) {
                return false;
            }

            $this->prescription->update($command->prescription(), $command->id());
        }

    }
}
