<?php

namespace App\Repositories;

use App\Core\MyPatients\Domain\RecordPathologies\Contracts\RecordPathologiesInterface;
use App\Models\RecordPathologies;
use Illuminate\Database\Eloquent\Collection;

class RecordPathologiesRepository extends BaseRepository implements RecordPathologiesInterface
{
    public function model(): ?string
    {
        return RecordPathologies::class;
    }

    public function updateOrCreateRecordPathologies (int $record_id, array $prescription_pathologies): void
    {
        $this->query()->where(['record_id' => $record_id])->whereNotIn('pathology_id', $prescription_pathologies)->delete();

        foreach ($prescription_pathologies as $id) {
            $this->query()->updateOrCreate(['record_id' => $record_id, 'pathology_id' => $id], ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
