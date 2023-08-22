<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\PrescriptionFactory;
use Tests\TestCase;


class PrescriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_prescription()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);

        $response = $this->getJson('/api/prescriptions/1');
        $response->assertStatus(200);
        $response->assertJson(['prescription' => $prescription->toArray()]);
    }

    /** @test */
    public function find_prescription_by_patient_id()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);

        $response = $this->getJson('/api/prescriptions/patient/set5');
        $response->assertStatus(200);
        $response->assertJson(['prescriptions' => [$prescription->toArray()]]);
    }

    /** @test */
    public function find_prescription_by_consultation_id()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);

        $response = $this->getJson('/api/prescriptions/consultation/set1');
        $response->assertStatus(200);
        $response->assertJson(['prescriptions' => [$prescription->toArray()]]);
    }

    /** @test */
    public function find_prescription_by_record_id()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);

        $response = $this->getJson('/api/prescriptions/record/set3');
        $response->assertStatus(200);
        $response->assertJson(['prescriptions' => [$prescription->toArray()]]);
    }

    /** @test */
    public function create_prescription()
    {
        $prescription = [
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ];

        $response = $this->postJson('/api/prescriptions/store', $prescription);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Prescription added successfully', 'Prescription' => $prescription]);
        $this->assertDatabaseHas('prescriptions',[
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);
    }

    /** @test */
    public function update_prescription()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 1,
            'patient_id' => 3,
            'consultation_id' => 2,
            'record_id' => 3,
            'doses_per_day' => 5,
            'days' => 135,
        ]);

        $update_prescription = [
            'prescriber_id' => 1,
            'patient_id' => 3,
            'consultation_id' => 2,
            'record_id' => 3,
            'doses_per_day' => 4,
            'days' => 136,
        ];

        $response = $this->postJson('/api/prescriptions/update/1', $update_prescription);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Prescriber updated successfully', 'Prescriber' => $prescriber]);
        $this->assertDatabaseHas('prescriptions',[
            'id' => 1,
            'prescriber_id' => 1,
            'patient_id' => 3,
            'consultation_id' => 2,
            'record_id' => 3,
            'doses_per_day' => 4,
            'days' => 136,
        ]);
    }

    /** @test */
    public function delete_prescription()
    {
        $prescription = (new PrescriptionFactory)->create([
            'id' => 1,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100,
        ]);

        $response = $this->postJson('/api/prescriptions/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('prescriptions', [
            'id' => 1,
        ]);
    }
}
