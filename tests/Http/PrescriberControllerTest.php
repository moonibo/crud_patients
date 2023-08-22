<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\PrescriberFactory;
use Tests\TestCase;


class PrescriberControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_prescriber()
    {
        $prescriber = (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);

        $response = $this->getJson('/api/prescribers/1');
        $response->assertStatus(200);
        $response->assertJson(['prescriber' => $prescriber->toArray()]);
    }

    /** @test */
    public function find_prescriber_by_consultation_id()
    {
        $prescriber = (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);

        $response = $this->getJson('/api/prescribers/consultation/set3');
        $response->assertStatus(200);
        $response->assertJson(['prescribers' => [$prescriber->toArray()]]);
    }

    /** @test */
    public function find_prescriber_by_speciality_id()
    {
        $prescriber = (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);

        $response = $this->getJson('/api/prescribers/speciality/set2');
        $response->assertStatus(200);
        $response->assertJson(['prescribers' => [$prescriber->toArray()]]);
    }

    /** @test */
    public function create_prescriber()
    {
        $prescriber = [
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ];

        $response = $this->postJson('/api/prescribers/store', $prescriber);
        $response->assertStatus(200);
        $response->assertJson(['output' => 'Prescriber added successfully', 'Prescriber' => $prescriber]);
        $this->assertDatabaseHas('prescribers',[
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3,
        ]);
    }

    /** @test */
    public function update_prescriber()
    {
        $prescriber = (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'John Doe',
            'speciality_id' => 1,
            'consultation_id' => 1,
        ]);

        $update_prescriber = [
            'name' => 'John Doe',
            'speciality_id' => 3,
            'consultation_id' => 4,
        ];

        $response = $this->postJson('/api/prescribers/update/1', $update_prescriber);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Prescriber updated successfully', 'Prescriber' => $prescriber]);
        $this->assertDatabaseHas('prescribers',[
            'name' => 'John Doe',
            'speciality_id' => 3,
            'consultation_id' => 4,
        ]);
    }

    /** @test */
    public function delete_prescriber()
    {
        $prescriber = (new PrescriberFactory)->create([
            'id' => 1,
            'name' => 'John Doe',
            'speciality_id' => 1,
            'consultation_id' => 2,
        ]);

        $response = $this->postJson('/api/prescribers/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('prescribers', [
            'id' => 1,
        ]);

    }
}
