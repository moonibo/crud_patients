<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\ConsultationFactory;
use Tests\Factories\PatientFactory;
use Tests\Factories\PrescriberFactory;
use Tests\Factories\SpecialityFactory;
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
        $response->assertJson(['patient' =>
            ['id' => 1,
            'name' => 'John',
            'surname' => 'Doe',
            'mail' => 'johndoe@test.com',
            'gender' => 'H',
            'prescriber_id' => null]]);
    }

    /** @test */
    public function find_patients_by_prescriber_id_then_get_users() {
        $user = (new PatientFactory)->create([
            'id' => 1,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 1,
            'prescriber_id' => 2
        ]);

        $response = $this->getJson('/api/patients/prescribers/2');
        $response->assertStatus(200);
        $response->assertJson(['patients' => [$user->toArray()]]);
    }

    /** @test */
    public function create_user()
    {
        (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'Test',
            'speciality_id' => 1,
            'consultation_id' => 2
        ]);
        (new SpecialityFactory)->create([
            'id' => 1,
            'name' => 'Test',
        ]);
        (new ConsultationFactory)->create([
            'id' => 2,
            'name' => 'Test'
        ]);

        $user = [
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 'M',
            'prescriber_id' => 1
        ];

        $response = $this->postJson('/api/patients/store', $user);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patients',[
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 1,
            'prescriber_id' => 1
        ]);
    }

    /** @test */
    public function update_user()
    {
        (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'Test',
            'speciality_id' => 1,
            'consultation_id' => 2
        ]);
        (new SpecialityFactory)->create([
            'id' => 1,
            'name' => 'Test',
        ]);
        (new ConsultationFactory)->create([
            'id' => 2,
            'name' => 'Test'
        ]);
        (new PatientFactory)->create([
            'id' => 1,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 1,
            'prescriber_id' => null
        ]);

        $update_user = [
            'name' => 'Maria',
            'surname' => 'Test',
            'mail' => 'mariatest@test.com',
            'gender' => 'M',
            'prescriber_id' => 1
        ];

        $response = $this->putJson('/api/patients/1', $update_user);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patients',[
            'id' => 1,
            'name' => 'Maria',
            'surname' => 'Test',
            'mail' => 'mariatest@test.com',
            'gender' => 1,
            'prescriber_id' => 1
        ]);
    }

    /** @test */
    public function delete_user()
    {
        (new PatientFactory)->create([
            'id' => 1,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 1,
            'prescriber_id' => null
        ]);

        $response = $this->postJson('/api/patients/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('patients', [
            'id' => 1,
        ]);

    }

}
