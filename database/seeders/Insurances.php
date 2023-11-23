<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Insurances extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurances')->insert([
            ['name' => 'SIN SEGURO', 'coverage' => 0, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'ARS SENASA', 'coverage' => 50, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'ARS HUMANO', 'coverage' => 50, 'created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
