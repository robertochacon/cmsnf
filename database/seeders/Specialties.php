<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specialties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            ['name'=>'GINECOLOGÍA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'OTORRINO','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'PEDIATRÍA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'PSICOLOGÍA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA FAMILIAR','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'ANESTESIOLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'FISIOTERAPIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'GASTRO','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICINA INTERNA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'NEFROLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'NEUROCIRUGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'NEUMOLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'ORTOPEDIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'ONCO-CIRUGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'MEDICO FAMILIAR','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'EMERGENCIOLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'DIABETOLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'UROLOGIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'CIRUGÍA VASCULAR','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'GERIATRIA','created_at' => date("Y-m-d H:i:s")],
            ['name'=>'CIRUGÍA GENERAL','created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
