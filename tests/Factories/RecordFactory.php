<?php

namespace Tests\Factories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    protected $model = Record::class;

    public function definition(): array
    {
        return [
            'id' => '',
            'prescriber_id' => '',
            'patient_id' => '',
            'start_date' => '',
            'end_date' => '',
        ];
    }
}
