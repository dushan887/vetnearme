<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::firstOrCreate(['name' => 'super_admin']);
        App\Role::firstOrCreate(['name' => 'admin']);
        App\Role::firstOrCreate(['name' => 'moderator']);
        App\Role::firstOrCreate(['name' => 'user']);

    }
}
