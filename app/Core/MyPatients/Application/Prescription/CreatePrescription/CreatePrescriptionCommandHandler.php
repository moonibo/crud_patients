<?php

namespace App\Core\MyPatients\Application\Prescription\CreatePrescription;

use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CreatePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly PrescriberInterface $prescriber,
                                private readonly PatientInterface $patient,
                                private readonly ConsultationInterface $consultation,
                                private readonly RecordInterface $record){}

    public function handle(CreatePrescriptionCommand $command)
    {
        if (is_null($this->prescriber->find($command->prescriberId()))) {
            return false;
        }

        if (is_null($this->patient->find($command->patientId()))) {
            return false;
        }

        if (is_null($this->consultation->find($command->consultationId()))) {
            return false;
        }

        if (is_null($this->record->find($command->recordId()))) {
            $record = $this->record->findLatestOpenRecordByPatientAndPrescriberId($command->patientId(), $command->prescriberId());
            if ($record) {
                $this->prescription->create([...$command->prescription(), 'record_id' => $record->id]);
            } else {
                $new_record = $this->createNewRecordWhenExpired($command->patientId(), $command->prescriberId());
                $this->prescription->create([...$command->prescription(), 'record_id' => $new_record->id]);
            }
        }

        $this->prescription->create($command->prescription());
    }

    public function createNewRecordWhenExpired(int $patient_id, int $prescriber_id)
    {
        $new_record_attr = [
            'prescriber_id' => $prescriber_id,
            'patient_id' => $patient_id,
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addMonths(3)->toDateString(),
        ];

        return $this->record->create($new_record_attr);
    }
}
