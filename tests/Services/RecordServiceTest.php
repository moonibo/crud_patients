<?php

namespace Tests\Services;

use App\Services\PatientInterface;
use App\Services\PrescriberInterface;
use App\Services\PrescriptionInterface;
use App\Services\RecordInterface;
use App\Services\RecordService;
use Tests\TestCase;
use Mockery\MockInterface;


class RecordServiceTest extends TestCase
{

    /** @test */
    public function give_id_when_show_then_get_record()
    {
        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'prescriber_id' => 3,
                    'patient_id' => 4,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-08-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->show(1);
        $this->assertEquals([
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01'
        ], $record);
    }

    /** @test */
    public function find_record_by_prescriber_id()
    {
        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findByPrescriberId')
                ->once()
                ->with(3)
                ->andReturn([
                    'prescriber_id' => 3,
                    'patient_id' => 4,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-08-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->findPrescriberById(3);
        $this->assertEquals([
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01'
        ], $record);
    }

    /** @test */
    public function find_record_by_patient_id()
    {
        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findByPatientId')
                ->once()
                ->with(4)
                ->andReturn([
                    'prescriber_id' => 3,
                    'patient_id' => 4,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-08-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->findPatientById(4);
        $this->assertEquals([
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01'
        ], $record);
    }

    /** @test */
    public function show_record_by_patient_id_and_prescriber_id()
    {
        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findRecordByPatientIdAndPrescriberId')
                ->once()
                ->with(4,3)
                ->andReturn([
                    'prescriber_id' => 3,
                    'patient_id' => 4,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-08-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->findRecordByPatientIdAndPrescriberId(4,3);

        $this->assertEquals([
            'prescriber_id' => 3,
            'patient_id' => 4,
            'start_date' => '2023-04-01',
            'end_date' => '2023-08-01'
        ], $record);
    }

    /** @test */
    public function create_record()
    {
        $attributes = [
            'prescriber_id' => 1,
            'patient_id' => 7,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01'
        ];

        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        $patient->shouldReceive('find')->once()->with($attributes['patient_id'])->andReturn(true);
        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('create')
                ->once()
                ->with($attributes)
                ->andReturn([
                    'prescriber_id' => 1,
                    'patient_id' => 7,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-11-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->store($attributes);

        $this->assertEquals([
            'prescriber_id' => 1,
            'patient_id' => 7,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01'
        ], $record);
    }

    /** @test */
    public function update_record()
    {
        $attributes = [
            'prescriber_id' => 1,
            'patient_id' => 7,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01'
        ];

        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);

        $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        $patient->shouldReceive('find')->once()->with($attributes['patient_id'])->andReturn(true);
        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('update')
                ->once()
                ->with($attributes, 1)
                ->andReturn([
                    'prescriber_id' => 1,
                    'patient_id' => 7,
                    'start_date' => '2023-04-01',
                    'end_date' => '2023-11-01'
                ]);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $record = $service->update($attributes, 1);

        $this->assertEquals([
            'prescriber_id' => 1,
            'patient_id' => 7,
            'start_date' => '2023-04-01',
            'end_date' => '2023-11-01'
        ], $record);
    }

    /** @test */
    public function delete_record()
    {
        $prescription = $this->mock(PrescriptionInterface::class);
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $repository = $this->mock(RecordInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new RecordService($repository, $prescriber, $patient, $prescription);
        $this->assertTrue($service->delete(1));
    }
}
