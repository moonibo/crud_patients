<?php

namespace Tests\Factories;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationFactory extends Factory
{
    protected $model = Consultation::class;

    public function definition(): array
    {
        return [
            'id' => '',
            'name' => '',
        ];
    }
}
