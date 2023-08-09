<?php

namespace Tests\Unit;

use App\Repositories\PatientRepository;
use App\Services\PatientInterface;
use App\Services\PatientService;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $repo = $this->createMock(PatientRepository::class);
        $repo->shouldRecive('all')->return([
            [
                'name' => 'Mònica',
                'lastname'=> ''
            ]
        ]);



        $service = new PatientService($repo);

        $service->index();

        $this->assertTrue(true);
    }
}
