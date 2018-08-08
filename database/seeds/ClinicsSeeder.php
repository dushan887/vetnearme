<?php

use Illuminate\Database\Seeder;

class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // \DB::table('clinics')->truncate();
        // \DB::table('clinic_images')->truncate();
        // \DB::table('clinics_services')->truncate();

        \DB::unprepared(\File::get(resource_path() . '/sql/clinics.sql'));

        // \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
