<?php

namespace App\Console\Commands;

use App\Core\MyPatients\Application\Prescription\MakeOldPrescriptionsNotEditable\MakeOldPrescriptionsNotEditableCommandHandler;
use Illuminate\Console\Command;

class UpdatePrescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:prescriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set is_editable column to false if prescriptions last update is older than 15 minutes';

    /**
     * Execute the console command.
     */
    public function handle(MakeOldPrescriptionsNotEditableCommandHandler $handler): void
    {
        $handler->handle();
    }
}
