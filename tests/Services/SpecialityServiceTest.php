<?php

namespace Tests\Services;

use App\Services\SpecialityInterface;
use App\Services\SpecialityService;
use Tests\TestCase;
use Mockery\MockInterface;


class SpecialityServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_speciality()
    {
        $repository = $this->mock(SpecialityInterface::class, function(MockInterface $mock){
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'Example Speciality'
                ]);
        });

        $service = new SpecialityService($repository);
        $speciality = $service->show(1);
        $this->assertEquals([
            'name' => 'Example Speciality'
        ], $speciality);
    }

    /** @test */
    public function create_speciality()
    {
        $attributes = [
            'name' => 'Example Speciality'
        ];

        $repository = $this->mock(SpecialityInterface::class, function(MockInterface $mock) use ($attributes){
            $mock->shouldReceive('create')
                ->once()
                ->with($attributes)
                ->andReturn([
                    'name' => 'Example Speciality'
                ]);
        });

        $service = new SpecialityService($repository);
        $speciality = $service->store($attributes);
        $this->assertEquals([
            'name' => 'Example Speciality'
        ], $speciality);
    }

    /** @test */
    public function update_speciality()
    {
        $attributes = [
            'name' => 'Example Speciality 2'
        ];

        $repository = $this->mock(SpecialityInterface::class, function(MockInterface $mock) use ($attributes){
            $mock->shouldReceive('update')
                ->once()
                ->with($attributes, 1)
                ->andReturn([
                    'name' => 'Example Speciality 2'
                ]);
        });

        $service = new SpecialityService($repository);
        $speciality = $service->update($attributes, 1);
        $this->assertEquals([
            'name' => 'Example Speciality 2'
        ], $speciality);
    }

    /** @test */
    public function delete_speciality()
    {
        $repository = $this->mock(SpecialityInterface::class, function(MockInterface $mock){
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new SpecialityService($repository);
        $this->assertTrue($service->delete(1));
    }

}
