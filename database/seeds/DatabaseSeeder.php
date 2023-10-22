<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
//            PermissionsTableSeeder::class,
//            RolesTableSeeder::class,
//            PermissionRoleTableSeeder::class,
//            UsersTableSeeder::class,
            ServiceTableSeeder::class,
            TimeSlotsTableSeeder::class,
            ModeOfSchedule::class,
//            RoleUserTableSeeder::class,
        ]);
    }
}
