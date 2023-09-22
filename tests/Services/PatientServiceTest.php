<?php

namespace Tests\Services;

use App\Services\PatientInterface;
use App\Services\PatientService;
use App\Services\PrescriberInterface;
use Tests\TestCase;
use Mockery\MockInterface;
//use App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface;


class PatientServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_user()
    {
        $prescriber = $this->mock(PrescriberInterface::class);

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

        $service = new PatientService($repository, $prescriber);
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
        $prescriber = $this->mock(PrescriberInterface::class);

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

        $service = new PatientService($repository, $prescriber);
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
            'prescriber_id' => null
        ];

        $prescriber = $this->mock(PrescriberInterface::class);

        if (isset($attributes['prescriber_id'])) {
            $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        }

        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) use ($attributes) {
           $mock->shouldReceive('create')
               ->once()
               ->andReturn([
                   'name' => 'Monica',
                   'surname' => 'Test',
                   'mail' => 'monicatest@test.com',
                   'gender' => 'M',
                   'prescriber_id' => null
               ]);
        });

        $service = new PatientService($repository, $prescriber);
        $this->assertEquals([
            'name' => 'Monica',
            'surname' => 'Test',
            'mail' => 'monicatest@test.com',
            'gender' => 'M',
            'prescriber_id' => null],
            $service->store($attributes));
    }

    /** @test */
    public function update_user()
    {
        $attributes = [
            'name' => 'Maria',
            'surname' => 'Test',
            'mail' => 'mariatest@test.com',
            'gender' => 1,
            'prescriber_id' => null
        ];

        $prescriber = $this->mock(PrescriberInterface::class);

        if (isset($attributes['prescriber_id'])) {
            $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        }

        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock) use ($attributes)  {
            $mock->shouldReceive('update')
                ->with($attributes, 1)
                ->once()
                ->andReturn([
                    'name' => 'Maria',
                    'surname' => 'Test',
                    'mail' => 'mariatest@test.com',
                    'gender' => 'M',
                    'prescriber_id' => null
                ]);
        });

        $service = new PatientService($repository, $prescriber);
        $this->assertEquals([
            'name' => 'Maria',
            'surname' => 'Test',
            'mail' => 'mariatest@test.com',
            'gender' => 'M',
            'prescriber_id' => null
        ], $service->update($attributes, 1));

    }

    /** @test */
    public function delete_user()
    {
        $prescriber = $this->mock(PrescriberInterface::class);

        $repository = $this->mock(PatientInterface::class, function(MockInterface $mock)  {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new PatientService($repository, $prescriber);
        $this->assertTrue($service->delete(1));
    }
}
