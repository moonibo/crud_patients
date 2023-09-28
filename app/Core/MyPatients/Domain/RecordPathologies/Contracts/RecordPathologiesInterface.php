<?php

namespace App\Core\MyPatients\Domain\RecordPathologies\Contracts;

use App\Models\RecordPathologies;

interface RecordPathologiesInterface
{
    public function all();

    public function create(array $attributes);

    public function update (array $attributes, int $id);

    public function find (int $id);

    //public function deleteOldPathologies(array $prescription_pathologies, int $record_id);

    public function updateOrCreateRecordPathologies (int $record_id, array $prescription_pathologies);

    public function delete (int $id);
}
