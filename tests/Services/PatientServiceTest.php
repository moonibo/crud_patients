<?php

namespace Tests\Services;

use App\Models\Patient;
use App\Services\PatientInterface;
use App\Services\PatientService;
use Tests\TestCase;
use Mockery\MockInterface;


class PatientServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_user()
    {
        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'John',
                    'surname' => 'Doe',
                    'mail' => 'johndoe@test.com',
                    'gender' => 'H'
                ]);
        });

        $service = new PatientService($repository);
        $patient = $service->show(1);
        $this->assertEquals([
            'name' => 'John',
            'surname' => 'Doe',
            'mail' => 'johndoe@test.com',
            'gender' => 'H'
        ], $patient);
    }

    /** @test */
    public function find_patients_by_prescriber_id_then_get_users()
    {
        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findPrescriberById')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'Monica',
                    'surname' => 'Test',
                    'mail' => 'monicatest@test.com',
                    'gender' => 'M'
                ]);
        });

        $service = new PatientService($repository);
        $patient = $service->findPrescriberById(1);
        $this->assertEquals([
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 'M'
        ], $patient);
    }

    /** @test */
    public function create_user()
    {
        $attributes = [
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 'M',
        ];
        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) use ($attributes) {
           $mock->shouldReceive('create')
               ->once()
               ->andReturn([
                   'name' => 'Monica',
                   'surname' => 'Test',
                   'mail' => 'monicatest@test.com',
                   'gender' => 'M'
               ]);
        });

        $service = new PatientService($repository);
        $created_patient = $service->store($attributes);
        $this->assertEquals([
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 'M'],
            $created_patient);

    }

    /** @test */
    public function update_user()
    {
        $attributes = [
            'name' => 'Maria',
            'surname' => 'Test',
            'mail' => 'mariatest@test.com',
            'gender' => 'M',
        ];

        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) use ($attributes)  {
            $mock->shouldReceive('update')
                ->once()
                //->with($attributes,1)
                ->andReturn([
                    'name' => 'Maria',
                    'surname' => 'Test',
                    'mail' => 'mariatest@test.com',
                    'gender' => 'M'
                ]);
        });

        $service = new PatientService($repository);
        $updated_patient = $service->update($attributes, 1);
        $this->assertDatabaseHas('patients', [
            'mail' => 'mariatest@test.com',
        ], $updated_patient);

    }

    /** @test */
    public function delete_user()
    {
        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock)  {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn([
                    true
                ]);
        });

        $service = new PatientService($repository);
        $service->delete(1);
        $this->assertDatabaseMissing('patients', [
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 1,
        ]);

    }
}
