<?php

namespace Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\SpecialityFactory;
use Tests\TestCase;


class SpecialityControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function give_id_when_show_then_get_speciality()
    {
        $speciality = (new SpecialityFactory)->create([
            'id' => 1,
            'name' => 'Example Speciality',
        ]);

        $response = $this->getJson('/api/specialities/1');
        $response->assertStatus(200);
        $response->assertJson(['speciality' => $speciality->toArray()]);
    }

    /** @test */
    public function create_speciality()
    {
        $speciality = [
            'name' => 'Example Speciality',
        ];

        $response = $this->postJson('/api/specialities/store', $speciality);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Speciality added successfully', 'Speciality' => $speciality]);
        $this->assertDatabaseHas('specialities',[
            'name' => 'Example Speciality',
        ]);
    }

    /** @test */
    public function update_speciality()
    {
        $speciality = (new SpecialityFactory)->create([
            'id' => 1,
            'name' => 'Example Speciality',
        ]);

        $update_speciality = [
            'name' => 'Example Speciality 2',
        ];

        $response = $this->putJson('/api/specialities/1', $update_speciality);
        $response->assertStatus(200);
        //$response->assertJson(['output' => 'Speciality added successfully', 'Speciality' => $speciality]);
        $this->assertDatabaseHas('specialities',[
            'id' => 1,
            'name' => 'Example Speciality 2',
        ]);
    }

    /** @test */
    public function delete_speciality()
    {
        $speciality = (new SpecialityFactory)->create([
            'id' => 1,
            'name' => 'Example Speciality',
        ]);

        $response = $this->postJson('/api/specialities/delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('specialities', [
            'id' => 1,
        ]);
    }
}
