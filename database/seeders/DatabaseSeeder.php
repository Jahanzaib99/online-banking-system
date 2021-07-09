<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->call(RolesPermissionsTablesSeeder::class);
        $this->call(UserSeeder::class);
    }
    public function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        //UserProfile::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
