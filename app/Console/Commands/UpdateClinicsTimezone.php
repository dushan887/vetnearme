<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Clinic;
use App\Helpers\Geolocation;

class UpdateClinicsTimezone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clinics:timezone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update clinics timezone';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clinics = Clinic::all();

        foreach ($clinics as $clinic)
        {
            $timezone = Geolocation::getTimezoneCoordinates([
                'lat' => $clinic->lat,
                'lng' => $clinic->lng,
            ]);

            $clinic->timezone = $timezone->zoneName;

            $clinic->save();

            sleep(2);
        }

        echo 'done';
    }
}
