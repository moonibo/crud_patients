<?php

namespace Tests\Services;

use App\Services\ConsultationInterface;
use App\Services\PatientInterface;
use App\Services\PrescriberInterface;
use App\Services\PrescriptionInterface;
use App\Services\PrescriptionService;
use App\Services\RecordInterface;
use Tests\TestCase;
use Mockery\MockInterface;


class PrescriptionServiceTest extends TestCase
{
    /** @test */
    public function give_id_when_show_then_get_prescription()
    {
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('find')
                ->once()
                ->with(1)
                ->andReturn([
                    'prescriber_id' => 2,
                    'patient_id' => 5,
                    'consultation_id' => 1,
                    'record_id' => 3,
                    'doses_per_day' => 3,
                    'days' => 100
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->show(1);
        $this->assertEquals([
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ], $prescription);
    }

    /** @test */
    public function find_prescription_by_patient_id()
    {
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findPatientById')
                ->once()
                ->with(5)
                ->andReturn([
                    'prescriber_id' => 2,
                    'patient_id' => 5,
                    'consultation_id' => 1,
                    'record_id' => 3,
                    'doses_per_day' => 3,
                    'days' => 100
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->findPatientById(5);
        $this->assertEquals([
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ], $prescription);
    }

    /** @test */
    public function find_prescription_by_consultation_id()
    {
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findConsultationById')
                ->once()
                ->with(1)
                ->andReturn([
                    'prescriber_id' => 2,
                    'patient_id' => 5,
                    'consultation_id' => 1,
                    'record_id' => 3,
                    'doses_per_day' => 3,
                    'days' => 100
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->findConsultationById(1);
        $this->assertEquals([
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ], $prescription);
    }

    /** @test */
    public function find_prescription_by_record_id()
    {
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('findRecordById')
                ->once()
                ->with(3)
                ->andReturn([
                    'prescriber_id' => 2,
                    'patient_id' => 5,
                    'consultation_id' => 1,
                    'record_id' => 3,
                    'doses_per_day' => 3,
                    'days' => 100
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->findRecordById(3);
        $this->assertEquals([
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ], $prescription);
    }

    /** @test */
    public function create_prescription()
    {
        $attributes = [
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ];

        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        $patient->shouldReceive('find')->once()->with($attributes['patient_id'])->andReturn(true);
        $consultation->shouldReceive('find')->once()->with($attributes['consultation_id'])->andReturn(true);
        $record->shouldReceive('find')->once()->with($attributes['record_id'])->andReturn(true);
        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('create')
                ->once()
                ->with($attributes)
                ->andReturn([
                    'prescriber_id' => 2,
                    'patient_id' => 5,
                    'consultation_id' => 1,
                    'record_id' => 3,
                    'doses_per_day' => 3,
                    'days' => 100
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->store($attributes);
        $this->assertEquals([
            'prescriber_id' => 2,
            'patient_id' => 5,
            'consultation_id' => 1,
            'record_id' => 3,
            'doses_per_day' => 3,
            'days' => 100
        ], $prescription);
    }

    /** @test */
    public function update_prescription()
    {
        $attributes = [
            'prescriber_id' => 1,
            'patient_id' => 3,
            'consultation_id' => 2,
            'record_id' => 3,
            'doses_per_day' => 5,
            'days' => 135,
        ];

        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $prescriber->shouldReceive('find')->once()->with($attributes['prescriber_id'])->andReturn(true);
        $patient->shouldReceive('find')->once()->with($attributes['patient_id'])->andReturn(true);
        $consultation->shouldReceive('find')->once()->with($attributes['consultation_id'])->andReturn(true);
        $record->shouldReceive('find')->once()->with($attributes['record_id'])->andReturn(true);
        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) use ($attributes) {
            $mock->shouldReceive('update')
                ->once()
                ->with($attributes, 1)
                ->andReturn([
                    'prescriber_id' => 1,
                    'patient_id' => 3,
                    'consultation_id' => 2,
                    'record_id' => 3,
                    'doses_per_day' => 5,
                    'days' => 135
                ]);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $prescription = $service->update($attributes, 1);
        $this->assertEquals([
            'prescriber_id' => 1,
            'patient_id' => 3,
            'consultation_id' => 2,
            'record_id' => 3,
            'doses_per_day' => 5,
            'days' => 135
        ], $prescription);
    }

    /** @test */
    public function delete_prescription()
    {
        $prescriber = $this->mock(PrescriberInterface::class);
        $patient = $this->mock(PatientInterface::class);
        $consultation = $this->mock(ConsultationInterface::class);
        $record = $this->mock(RecordInterface::class);

        $repository = $this->mock(PrescriptionInterface::class, function(MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->with(1)
                ->andReturn(true);
        });

        $service = new PrescriptionService($repository, $prescriber, $patient, $consultation, $record);
        $this->assertTrue($service->delete(1));
    }
}
