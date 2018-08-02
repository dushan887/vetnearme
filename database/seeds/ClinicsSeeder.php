<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;


class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('clinics')->truncate();
        \DB::table('clinic_images')->truncate();
        \DB::table('clinics_services')->truncate();

        $file = public_path() . '/csv/all.csv';
        $csv  = Reader::createFromPath($file, 'r');

        $csv->setHeaderOffset(0);

        $date = date('Y-m-d H:i:s');

        $records = $stmt->process($csv);

        $stmt = (new Statement());

        $records = $stmt->process($csv);

        foreach ($records as $record) {

            \DB::table('clinics')->insert([
                'name'                     => $row[1],
                'description'              => '',
                'special_notes'            => '',
                'email'                    => $row[4],
                'phone_number'             => $row[5],
                'emergency_number'         => $row[6],
                'city'                     => $row[0],
                'address'                  => $row[0],
                'zip'                      => $row[0],
                'state'                    => $row[0],
                'country_id'               => $row[0],
                'lat'                      => $row[0],
                'lng'                      => $row[0],
                'gmaps_link'               => $row[0],
                'social_media'             => $row[0],
                'opening_hours'            => [],
                'general_practice'         => $row[0],
                'specialist_and_emergency' => $row[0],
                'subscribe'                => $row[0],
                'accessibility'            => $row[0],
                'logo'                     => null,
                'marker'                   => null,
                'owener_id'                => null,
                'created_at'               => $date,
                'updated_at'               => $date,
            ]);

        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
