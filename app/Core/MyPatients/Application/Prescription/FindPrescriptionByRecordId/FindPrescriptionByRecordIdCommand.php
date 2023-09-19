<?php

namespace App\Core\MyPatients\Application\Prescription\FindPrescriptionByRecordId;

class FindPrescriptionByRecordIdCommand
{
    private int $record_id;

    public function __construct(int $id)
    {
        $this->record_id = $id;
    }

    public function recordId(): int
    {
        return $this->record_id;
    }
}
