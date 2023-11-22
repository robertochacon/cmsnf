<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Professions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professions')->insert([
            ['name'=>'MEDICINA CLINICA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA QUIRURGICA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICO QUIRURGICO','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICO DE LABORATORIO','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA FORENSE','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA LABORAL','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA PREVENTIVA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA DEPORTIVA','created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
