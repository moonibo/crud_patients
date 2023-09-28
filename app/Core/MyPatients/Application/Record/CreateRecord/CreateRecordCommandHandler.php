<?php

namespace App\Core\MyPatients\Application\Record\CreateRecord;

use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Core\MyPatients\Domain\Allergy\Services\AllergyFinder;
use App\Core\MyPatients\Domain\Pathology\Exceptions\PathologyNotFoundException;
use App\Core\MyPatients\Domain\Pathology\Services\PathologyFinder;
use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Patient\Services\PatientFinder;
use App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use App\Core\MyPatients\Domain\Record\Contracts\RecordInterface;
use App\Core\MyPatients\Domain\RecordAllergies\Contracts\RecordAllergiesInterface;
use App\Core\MyPatients\Domain\RecordPathologies\Contracts\RecordPathologiesInterface;
use function PHPUnit\Framework\isEmpty;

class CreateRecordCommandHandler
{
    public function __construct(private readonly RecordInterface $record,
                                private readonly PrescriberFinder $prescriberFinder,
                                private readonly PatientFinder $patientFinder,
                                private readonly AllergyFinder $allergyFinder,
                                private readonly PathologyFinder $pathologyFinder){}

    /**
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     * @throws AllergyNotFoundException
     * @throws PathologyNotFoundException
     */
    public function handle(CreateRecordCommand $command): void
    {
        $allergies_ids = [];
        $pathologies_ids = [];
        $timestamps = ['created_at' => now(), 'updated_at' => now()];

        $this->prescriberFinder->byIdOrFail($command->prescriberId());
        $this->patientFinder->byIdOrFail($command->patientId());

        if ($command->allergies()[0] !== null) {
            $allergies_ids = explode(',', $command->allergies()[0]);
            foreach ($allergies_ids as $id) {
                $this->allergyFinder->byIdOrFail($id);
            }
        }
        if ($command->pathologies()[0] !== null) {
            $pathologies_ids = explode(',', $command->pathologies()[0]);
            foreach ($pathologies_ids as $id) {
                $this->pathologyFinder->byIdOrFail($id);
            }
        }

        $record = $this->record->create($command->record());

        if(!empty($allergies_ids)) {
            $record->allergies()->attach($allergies_ids, $timestamps);
        }
        if (!empty($pathologies_ids)) {
            $record->pathologies()->attach($pathologies_ids, $timestamps);
        }

    }

}
