<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            ['name' => 'Administrativo', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad de Hematología/Oncología e Inmunología.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad Quirúrgica/Ortopédica Pediátrica.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad de Psiquiatría.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad de Neurología y Neurocirugía.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad de Nefrología/Gastroenterología/Endocrinología.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad Respiratoria.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Unidad Quirúrgica Médica Cardíaca.', 'created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
