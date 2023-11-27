<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'), // JGAyV3x2
            'remember_token' => null,
            'approved' => 1,
            'type' => 'super',
            'verified' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        User::create([
            'name' => 'Doctor admin',
            'email' => 'doctor@admin.com',
            'password' => bcrypt('admin'), // JGAyV3x2
            'remember_token' => null,
            'approved' => 1,
            'type' => 'doctor',
            'verified' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@doctor.com',
            'password' => bcrypt('doctor'), // JGAyV3x2
            'remember_token' => null,
            'approved' => 1,
            'type' => 'doctor',
            'verified' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
