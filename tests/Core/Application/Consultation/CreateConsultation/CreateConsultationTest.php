<?php

namespace Tests\Core\Application\Consultation\CreateConsultation;

use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateAllergyCommand;
use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateAllergyCommandHandler;
use App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateConsultationTest extends TestCase
{
    /** @test */
    public function create_consultation()
    {
        $consultation = [
            'name' => 'test consultation'
        ];

        $repository = $this->mock(ConsultationInterface::class, function (MockInterface $mock) use ($consultation) {
            $mock->shouldReceive('create')
                ->once()
                ->with($consultation)
                ->andReturn([
                    'name' => 'Example Consultation'
                ]);
        });

        $useCase =  new CreateAllergyCommandHandler($repository);
        $useCase->handle(new CreateAllergyCommand($consultation));
        $this->assertEquals(['name' => 'test consultation'], $consultation);

    }
}
