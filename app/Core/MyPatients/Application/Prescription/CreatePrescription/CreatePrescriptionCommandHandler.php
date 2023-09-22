<?php

namespace App\Core\MyPatients\Application\Prescription\CreatePrescription;

use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;
use Carbon\Carbon;

class CreatePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly RecordInterface $record,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder,
                                private readonly ConsultationFinder $consultationFinder,
                                private readonly RecordFinder $recordFinder){}

    /**
     * @throws ConsultationNotFoundException
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     */
    public function handle(CreatePrescriptionCommand $command): void
    {
        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());
        $this->consultationFinder->byIdOrFail($command->consultationId());

        if (!$this->recordFinder->byId($command->recordId())) {
            $record = $this->recordFinder->findLatestOpenRecordByPatientAndPrescriberId($command->patientId(), $command->prescriberId());
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
