<?php

namespace Tests\Core\Application\Consultation\CreateConsultation;

use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateConsultationCommand;
use App\Core\MyPatients\Application\Consultation\CreateConsultation\CreateConsultationCommandHandler;
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

        $useCase =  new CreateConsultationCommandHandler($repository);
        $useCase->handle(new CreateConsultationCommand($consultation));
        $this->assertEquals(['name' => 'test consultation'], $consultation);

    }
}
