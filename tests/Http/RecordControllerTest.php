<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\PatientFactory;
use Tests\Factories\PrescriberFactory;
use Tests\Factories\RecordFactory;
use Tests\TestCase;


class RecordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_record()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01',
        ]);

        $response = $this->getJson('/api/records/1');
        $response->assertStatus(200);
        $response->assertJson(['record' => $record->toArray()]);
    }

    /** @test */
    public function find_record_by_prescriber_id()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01',
        ]);

        $response = $this->getJson('/api/records/prescriber/3');
        $response->assertStatus(200);
        $response->assertJson(['records' => [$record->toArray()]]);
    }

    /** @test */
    public function find_record_by_patient_id()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01',
        ]);

        $response = $this->getJson('/api/records/patient/4');
        $response->assertStatus(200);
        $response->assertJson(['records' => [$record->toArray()]]);
    }

    /** @test */
    public function show_record_by_patient_id_and_prescriber_id()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);

        $response = $this->getJson('/api/records/patient&prescriber/4/3');
        $response->assertStatus(200);
        $response->assertJson(['record' => [$record->toArray()]]);
    }

    /** @test */
    public function create_record()
    {
        (new PrescriberFactory())->create([
            'id' => 3,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);

        (new PatientFactory())->create([
            'id' => 4,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monica@test.com',
            'gender' => 1,
            'prescriber_id' => null,
        ]);

        $record = [
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ];

        $response = $this->postJson('/api/records/store', $record);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Record added successfully', 'Record' => $record]);
        $this->assertDatabaseHas('records',[
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);
    }

    /** @test */
    public function update_record()
    {
        (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);

        (new PrescriberFactory())->create([
            'id' => 3,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);
        (new PrescriberFactory())->create([
            'id' => 2,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);


        (new PatientFactory())->create([
            'id' => 4,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monica@test.com',
            'gender' => 1,
            'prescriber_id' => null,
        ]);
        (new PatientFactory())->create([
            'id' => 5,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monica@test.com',
            'gender' => 1,
            'prescriber_id' => null,
        ]);

        $record = [
            'prescriber_id' => 2,
            'patient_id' => 5,
            'start_date' => '2023-04-10',
            'end_date' => '2023-09-12',
        ];

        $response = $this->putJson('/api/records/1', $record);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Record added successfully', 'Record' => $record]);
        $this->assertDatabaseHas('records',[
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'start_date' => '2023-04-10',
            'end_date' => '2023-09-12',
        ]);
    }

    /** @test */
    public function delete_record()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);

        $response = $this->postJson('/api/records/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('prescriptions', [
            'id' => 1,
        ]);
    }
}
