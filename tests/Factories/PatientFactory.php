<?php

namespace Tests\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'id' => '',
            'name' => '',
            'surname' => '',
            'mail' => '',
            'gender' => '',
            'prescriber_id' => ''
        ];
    }
}
