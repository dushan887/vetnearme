<?php

use Illuminate\Database\Seeder;

class SuperAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = \App\User::where('email', '=', 'super_admin_test@supertest.com')->first();

        if($superAdmin)
            return true;

        $role = \App\Role::where('name', '=', 'super_admin')->first();
        $date = Carbon\Carbon::now();

        $userID = DB::table('users')->insertGetId([
            'first_name' => "Super",
            'last_name'  => "Admin",
            'email'      => 'super_admin_test@supertest.com',
            'password'   => bcrypt('kAP7phKAeGsaXZBN'),
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::table('users_roles')->insert([
            'user_id' => $userID,
            'role_id' => $role->id,
        ]);

    }
}
