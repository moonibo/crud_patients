<?php

namespace Tests\Services;

use App\Services\ConsultationInterface;
use App\Services\PrescriberInterface;
use App\Services\PrescriberService;
use App\Services\SpecialityInterface;
use Tests\TestCase;
use Mockery\MockInterface;


class PrescriberServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_prescriber()
    {
        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'John Doe',
                    'speciality_id' => 2,
                    'consultation_id' => 3
                ]);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $prescriber = $service->show(1);
        $this->assertEquals([
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3
        ], $prescriber);
    }

    /** @test */
    public function find_prescriber_by_consultation_id()
    {
        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $mock){
           $mock->shouldReceive('findByConsultationId')
               ->once()
               ->with(1)
               ->andReturn([
                   'name' => 'John Doe',
                   'speciality_id' => 2,
                   'consultation_id' => 3
               ]);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $prescriber = $service->findConsultationById(1);
        $this->assertEquals([
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3
        ], $prescriber);
    }

    /** @test */
    public function find_prescriber_by_speciality_id()
    {
        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $mock){
            $mock->shouldReceive('findBySpecialityId')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'John Doe',
                    'speciality_id' => 2,
                    'consultation_id' => 3
                ]);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $prescriber = $service->findSpecialityById(1);
        $this->assertEquals([
            'name' => 'John Doe',
            'speciality_id' => 2,
            'consultation_id' => 3
        ], $prescriber);
    }

    /** @test */
    public function create_prescriber()
    {
        $attributes = [
            'name' => 'Monica Test',
            'speciality_id' => 1,
            'consultation_id' => 2
        ];

        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);

        $speciality->shouldReceive('find')->once()->with($attributes['speciality_id'])->andReturn(true);
        $consultation->shouldReceive('find')->once()->with($attributes['consultation_id'])->andReturn(true);

        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $mock) use ($attributes){
            $mock->shouldReceive('create')
                ->once()
                ->with($attributes)
                ->andReturn([
                    'name' => 'Monica Test',
                    'speciality_id' => 1,
                    'consultation_id' => 2
                ]);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $created_prescriber = $service->store($attributes);
        $this->assertEquals([
            'name' => 'Monica Test',
            'speciality_id' => 1,
            'consultation_id' => 2
        ], $created_prescriber);
    }

    /** @test */
    public function update_prescriber()
    {
        $attributes = [
            'name' => 'Monica Update',
            'speciality_id' => 1,
            'consultation_id' => 2
        ];

        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);

        $speciality->shouldReceive('find')->once()->with($attributes['speciality_id'])->andReturn(true);
        $consultation->shouldReceive('find')->once()->with($attributes['consultation_id'])->andReturn(true);

        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $Mock) use ($attributes) {
            $Mock->shouldReceive('update')
                ->once()
                ->with($attributes, 1)
                ->andReturn([
                    'name' => 'Monica Update',
                    'speciality_id' => 1,
                    'consultation_id' => 2
                ]);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $updated_prescriber = $service->update($attributes, 1);
        $this->assertEquals([
            'name' => 'Monica Update',
            'speciality_id' => 1,
            'consultation_id' => 2
        ], $updated_prescriber);
    }

    /** @test */
    public function delete_prescriber()
    {
        $speciality = $this->mock(SpecialityInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $repository = $this->mock(PrescriberInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new PrescriberService($repository, $speciality, $consultation);
        $this->assertTrue($service->delete(1));
    }
}
