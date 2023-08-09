<?php

namespace App\Listeners;

use App\Events\PatientsUpdated;
use App\Repositories\PatientRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\BaseRepository as baseRepository;

class PatientsUpdatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly PatientRepository $patientRepository)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PatientsUpdated $event): void
    {
        $gender = $event->patients->gender === 'H' ? 0 : 1;
        $event->patients->gender = $gender;

        $this->patientRepository->update((array)$event->patients, $event->patients->id);
    }
}
