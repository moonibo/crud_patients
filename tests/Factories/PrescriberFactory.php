<?php

namespace Tests\Factories;

use App\Models\Prescriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriberFactory extends Factory
{
    protected $model = Prescriber::class;

    public function definition(): array
    {
        return [
            'id' => '',
            'name' => '',
            'speciality_id' => '',
            'consultation_id' => '',
        ];
    }
}
