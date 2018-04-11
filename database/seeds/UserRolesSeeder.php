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
        $date = Carbon\Carbon::now();

        DB::table('roles')->delete();

        DB::table('roles')->insert([

            ['name' => 'super_admin', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'admin', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'moderator', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'user', 'created_at' => $date, 'updated_at' => $date],

        ]);
    }
}
