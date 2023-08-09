<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\PatientFactory;
use Tests\TestCase;


class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_user()
    {
        $user = (new PatientFactory)->create([
            'id' => 1,
            'name' => 'John',
            'surname' => 'Doe',
            'mail' => 'johndoe@test.com',
            'gender' => 0,
            'prescriber_id' => null
        ]);

        $response = $this->getJson('/api/patients/1');

        $response->assertStatus(200);
        $response->assertJson(['patient' => $user->toArray()]);
    }
}
