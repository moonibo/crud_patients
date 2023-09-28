<?php

namespace App\Providers;

use App\Core\MyPatients\Domain\Allergy\Contracts\AllergyInterface;
use App\Core\MyPatients\Domain\Method\Contracts\MethodInterface;
use App\Core\MyPatients\Domain\Pathology\Contracts\PathologyInterface;
use App\Core\MyPatients\Domain\RecordAllergies\Contracts\RecordAllergiesInterface;
use App\Core\MyPatients\Domain\RecordPathologies\Contracts\RecordPathologiesInterface;
use App\Core\MyPatients\Domain\RegisteredPrescriber\Contracts\RegisteredPrescriberInterface;
use App\Core\MyPatients\Domain\Step\Contracts\StepInterface;
use App\Repositories\AllergyRepository;
use App\Repositories\ConsultationRepository;
use App\Repositories\MethodRepository;
use App\Repositories\PathologyRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PrescriberRepository;
use App\Repositories\PrescriptionRepository;
use App\Repositories\RecordAllergiesRepository;
use App\Repositories\RecordPathologiesRepository;
use App\Repositories\RecordRepository;
use App\Repositories\RegisteredPrescriberRepository;
use App\Repositories\SpecialityRepository;
use App\Repositories\StepRepository;
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
        $this->app->bind(AllergyInterface::class, AllergyRepository::class);
        $this->app->bind(MethodInterface::class, MethodRepository::class);
        $this->app->bind(PathologyInterface::class, PathologyRepository::class);
        $this->app->bind(StepInterface::class, StepRepository::class);
        $this->app->bind(RecordAllergiesInterface::class, RecordAllergiesRepository::class);
        $this->app->bind(RecordPathologiesInterface::class, RecordPathologiesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
