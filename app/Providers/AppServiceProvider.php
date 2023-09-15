<?php

namespace App\Providers;

use App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts\RegisteredPrescriberInterface;
use App\Repositories\ConsultationRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PrescriberRepository;
use App\Repositories\PrescriptionRepository;
use App\Repositories\RecordRepository;
use App\Repositories\RegisteredPrescriberRepository;
use App\Repositories\SpecialityRepository;
use App\Services\ConsultationInterface;
use App\Services\PatientInterface;
use App\Services\PrescriberInterface;
use App\Services\PrescriptionInterface;
use App\Services\RecordInterface;
use App\Services\SpecialityInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientInterface::class, PatientRepository::class);
        $this->app->bind(PrescriberInterface::class, PrescriberRepository::class);
        $this->app->bind(SpecialityInterface::class, SpecialityRepository::class);
        $this->app->bind(ConsultationInterface::class, ConsultationRepository::class);
        $this->app->bind(RecordInterface::class, RecordRepository::class);
        $this->app->bind(PrescriptionInterface::class, PrescriptionRepository::class);

        $this->app->bind(\App\Core\MyPatients\Domain\Patient\Contracts\PatientInterface::class, PatientRepository::class);
        $this->app->bind(\App\Core\MyPatients\Domain\Prescriber\Contracts\PrescriberInterface::class, PrescriberRepository::class);
        $this->app->bind(\App\Core\MyPatients\Domain\Speciality\Contracts\SpecialityInterface::class, SpecialityRepository::class);
        $this->app->bind(\App\Core\MyPatients\Domain\Consultation\Contracts\ConsultationInterface::class, ConsultationRepository::class);
        $this->app->bind(\App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface::class, PrescriptionRepository::class);
        $this->app->bind(\App\Core\MyPatients\Domain\Record\Contracts\RecordInterface::class, RecordRepository::class);
        $this->app->bind(RegisteredPrescriberInterface::class, RegisteredPrescriberRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
