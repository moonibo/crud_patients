<?php

namespace Tests\Services;

use App\Services\ConsultationInterface;
use App\Services\ConsultationService;
use Tests\TestCase;
use Mockery\MockInterface;


class ConsultationServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_consultation()
    {
        $repository = $this->mock(ConsultationInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'name' => 'Example Consultation'
                ]);
        });

        $service = new ConsultationService($repository);
        $consultation = $service->show(1);
        $this->assertEquals([
            'name' => 'Example Consultation'
        ], $consultation);
    }

    /** @test */
    public function create_consultation()
    {
        $attributes = [
            'name' => 'Example Consultation'
        ];

        $repository = $this->mock(ConsultationInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('create')
                ->once()
                ->with($attributes)
                ->andReturn([
                    'name' => 'Example Consultation'
                ]);
        });

        $service = new ConsultationService($repository);
        $consultation = $service->store($attributes);
        $this->assertEquals([
            'name' => 'Example Consultation'
        ], $consultation);
    }

    /** @test */
    public function update_user()
    {
        $attributes = [
            'name' => 'Example Consultation 2'
        ];

        $repository = $this->mock(ConsultationInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('update')
                ->once()
                ->with($attributes, 1)
                ->andReturn([
                    'name' => 'Example Consultation 2'
                ]);
        });

        $service = new ConsultationService($repository);
        $consultation = $service->update($attributes,1);
        $this->assertEquals([
            'name' => 'Example Consultation 2'
        ], $consultation);
    }

    /** @test */
    public function delete_user()
    {
        $repository = $this->mock(ConsultationInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new ConsultationService($repository);
        $this->assertTrue($service->delete(1));
    }
}
