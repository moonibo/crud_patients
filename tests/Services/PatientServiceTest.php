<?php

namespace Tests\Services;

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
                    'id' => 1,
                    'name' => 'John Doe',
                    'mail' => 'johndoe@test.com'
                ]);
        });

        $service = new PatientService($repository);
        $patient = $service->show(1);
        $this->assertEquals([
            'id' => 1,
            'name' => 'John Doe',
            'mail' => 'johndoe@test.com'
        ], $patient);
    }
}
