<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\ConsultationFactory;
use Tests\TestCase;


class ConsultationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_consultation()
    {
        $consultation = (new ConsultationFactory)->create([
            'id' => 1,
            'name' => 'Example Consultation',
        ]);

        $response = $this->getJson('/api/consultations/1');
        $response->assertStatus(200);
        $response->assertJson(['consultation' => $consultation->toArray()]);
    }

    /** @test */
    public function create_consultation()
    {
        $consultation = [
            'name' => 'Example Consultation',
        ];

        $response = $this->postJson('/api/consultations/store', $consultation);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Consultation added successfully', 'Consultation' => $consultation]);
        $this->assertDatabaseHas('consultations',[
            'name' => 'Example Consultation',
        ]);
    }

    /** @test */
    public function update_consultation()
    {
        $consultation = (new ConsultationFactory)->create([
            'id' => 1,
            'name' => 'Example Consultation',
        ]);

        $update_consultation = [
            'name' => 'Example Consultation 2',
        ];

        $response = $this->putJson('/api/consultations/1', $update_consultation);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Consultation added successfully', 'Consultation' => $consultation]);
        $this->assertDatabaseHas('consultations',[
            'id' => 1,
            'name' => 'Example Consultation 2',
        ]);
    }

    /** @test */
    public function delete_consultation()
    {
        $consultation = (new ConsultationFactory)->create([
            'id' => 1,
            'name' => 'Example Consultation',
        ]);

        $response = $this->postJson('/api/consultations/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('consultations', [
            'id' => 1,
        ]);
    }
}
