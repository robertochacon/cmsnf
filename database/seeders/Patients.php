<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Patients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            ['user_id'=>1, 'sexo'=>'M', 'institution_id'=>1, 'name'=>'Roberto Chacon A.', 'identification'=>'40237252669', 'age'=>'25','phone'=>'8297821156','range'=>'MARINERO AUXILIAR','address'=>'Villa Altagracia','blood'=>'O+','created_at' => date("Y-m-d H:i:s")],
            ['user_id'=>1, 'sexo'=>'M', 'institution_id'=>2, 'name'=>'Juan Peralta', 'identification'=>'40237252660', 'age'=>'32','phone'=>'8097220022','range'=>null,'address'=>'Santo Domingo','blood'=>'A+','created_at' => date("Y-m-d H:i:s")]
        ]);
    }
}
