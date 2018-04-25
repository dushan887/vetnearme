<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesSeeder::class);
        $this->call(SuperAdminSeed::class);

        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!'); 
    }
}
