<?php

namespace App\Core\MyPatients\Application\Prescription\UpdatePrescription;

use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Prescription\Exceptions\PrescriptionNotFoundException;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;
use App\Core\MyPatients\Domain\Record\Exceptions\RecordNotFoundException;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;

class UpdatePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder,
                                private readonly ConsultationFinder $consultationFinder,
                                private readonly PrescriptionFinder $prescriptionFinder,
                                private readonly RecordFinder $recordFinder){}

    /**
     * @throws ConsultationNotFoundException
     * @throws RecordNotFoundException
     * @throws PatientNotFoundException
     * @throws PrescriptionNotFoundException
     * @throws PrescriberNotFoundException
     */
    public function handle(UpdatePrescriptionCommand $command): void
    {
        $this->prescriptionFinder->byIdOrFail($command->id());
        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());
        $this->consultationFinder->byIdOrFail($command->consultationId());
        $this->recordFinder->byIdOrFail($command->recordId());

        $this->prescription->update($command->prescription(), $command->id());
    }
}
