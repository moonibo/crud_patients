<?php

namespace Tests\Factories;

use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialityFactory extends Factory
{
    protected $model = Speciality::class;

    public function definition(): array
    {
        return [
            'id' => '',
            'name' => '',
        ];
    }
}
