<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Emergency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medical_consultations')->insert([
            [
                'department_id' => 1,
                'user_id' => 1,
                'patient_id' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
