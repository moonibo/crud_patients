<?php

namespace Tests\Http;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\ConsultationFactory;
use Tests\Factories\PatientFactory;
use Tests\Factories\PrescriberFactory;
use Tests\Factories\PrescriptionFactory;
use Tests\Factories\RecordFactory;
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

        $response = $this->getJson('/api/prescriptions/patient/5');
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

        $response = $this->getJson('/api/prescriptions/consultation/1');
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

        $response = $this->getJson('/api/prescriptions/record/3');
        $response->assertStatus(200);
        $response->assertJson(['prescriptions' => [$prescription->toArray()]]);
    }

    /** @test */
    public function create_prescription()
    {
        (new PrescriberFactory)->create([
            'id' => 2,
            'name' => 'Test',
            'speciality_id' => 1,
            'consultation_id' => 1
        ]);

        (new PatientFactory)->create([
            'id' => 5,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monica@test.com',
            'gender' => 1,
            'prescriber_id' => 2,
        ]);

        (new ConsultationFactory)->create([
            'id' => 1,
            'name' => 'Consulta Test',
        ]);

        (new RecordFactory)->create([
            'id' => 3,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'start_date' => '2023-08-01',
            'end_date' => '2023-12-01'
        ]);

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
        (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'Test',
            'speciality_id' => 1,
            'consultation_id' => 1
        ]);

        (new PatientFactory)->create([
            'id' => 3,
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monica@test.com',
            'gender' => 1,
            'prescriber_id' => 1,
        ]);

        (new ConsultationFactory)->create([
            'id' => 2,
            'name' => 'Consulta Test',
        ]);

        (new RecordFactory)->create([
            'id' => 3,
            'prescriber_id' => 2,
            'patient_id' => 5,
            'start_date' => '2023-08-01',
            'end_date' => '2023-12-01'
        ]);

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

        $response = $this->putJson('/api/prescriptions/1', $update_prescription);
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
