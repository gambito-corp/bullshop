<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Admin
        $user= User::create([
            'name' => 'Admin',
            'phone' => '7226049739',
            'email' => 'asesor.pedro@gmail.com',
            'profile' => 'Admin',
            'status' => 'Active',
            'password' => bcrypt('C4tntnox*+')
        ]);

        $user->syncRoles('Admin');
    }
}
