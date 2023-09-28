<?php

namespace App\Core\MyPatients\Application\Prescription\CreatePrescription;

use App\Core\MyPatients\Domain\Consultation\Exceptions\ConsultationNotFoundException;
use App\Core\MyPatients\Domain\Consultation\Services\ConsultationFinder;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\Record\Services\RecordFinder;
use App\Core\MyPatients\Domain\RecordPathologies\Contracts\RecordPathologiesInterface;
use App\Core\MyPatients\Domain\Step\Exceptions\StepNotFoundException;
use App\Core\MyPatients\Domain\Step\Services\StepFinder;
use Carbon\Carbon;

class CreatePrescriptionCommandHandler
{
    public function __construct(private readonly PrescriptionInterface $prescription,
                                private readonly RecordInterface $record,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder,
                                private readonly ConsultationFinder $consultationFinder,
                                private readonly RecordFinder $recordFinder,
                                private readonly StepFinder $stepFinder,
                                private readonly PathologyFinder $pathologyFinder,
                                private readonly RecordPathologiesInterface $recordPathologies){}

    /**
     * @throws ConsultationNotFoundException
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     * @throws StepNotFoundException
     * @throws PathologyNotFoundException
     */
    public function handle(CreatePrescriptionCommand $command): void
    {
        $pathologies_ids = [];
        $timestamps = ['created_at' => now(), 'updated_at' => now()];

        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());
        $this->consultationFinder->byIdOrFail($command->consultationId());
        $this->stepFinder->byIdOrFail($command->stepId());

        if ($command->pathologies()[0] !== null) {
            $pathologies_ids = explode(',', $command->pathologies()[0]);
            foreach ($pathologies_ids as $id) {
                $this->pathologyFinder->byIdOrFail($id);
            }
        }

        if (!$this->recordFinder->byId($command->recordId())) {
            $record = $this->recordFinder->findLatestOpenRecordByPatientAndPrescriberId($command->patientId(), $command->prescriberId());
            if ($record) {
                $prescription = $this->prescription->create([...$command->prescription(), 'record_id' => $record->id]);
                $prescription->pathologies()->attach($pathologies_ids, $timestamps);
                $this->recordPathologies->updateOrCreateRecordPathologies($record->id, $pathologies_ids);
            } else {
                $new_record = $this->createNewRecordWhenExpired($command->patientId(), $command->prescriberId());
                $prescription = $this->prescription->create([...$command->prescription(), 'record_id' => $new_record->id]);
                $prescription->pathologies()->attach($pathologies_ids, $timestamps);
                $this->recordPathologies->updateOrCreateRecordPathologies($new_record->id, $pathologies_ids);
            }
        } else {
            $this->recordPathologies->updateOrCreateRecordPathologies($command->recordId(), $pathologies_ids);
            $this->prescription->create($command->prescription());
        }
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
