<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response = $this->getJson('/api/records/prescriber/set3');
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

        $response = $this->getJson('/api/records/patient/set4');
        $response->assertStatus(200);
        $response->assertJson(['records' => [$record->toArray()]]);
    }

    /** @test */
    public function show_record_by_prescriber_id_and_patient_id()
    {
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);

        $response = $this->getJson('/api/records/patient&prescriber/set4/3');
        $response->assertStatus(200);
        $response->assertJson(['record' => [$record->toArray()]]);
    }

    /** @test */
    public function create_record()
    {
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
        $record = (new RecordFactory)->create([
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01',
        ]);

        $record = [
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-09-12',
        ];

        $response = $this->postJson('/api/records/update/1', $record);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Record added successfully', 'Record' => $record]);
        $this->assertDatabaseHas('records',[
            'id' => 1,
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
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
