<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =  User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => Hash::make('12345678'),
            'user_type' =>'admin',
            'avatar' =>'profiles/5fd1bcdde6728.jpeg',
            'gender' =>'Male',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $admin->assignRole('SuperAdmin');
    }
}
