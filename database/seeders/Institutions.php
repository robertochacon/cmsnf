<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Institutions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('institutions')->insert([
            ['name' => 'Ejército de República Dominicana', 'siglas' => 'ERD', 'phone' => '809-473-8000', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Armada de República Dominicana', 'siglas' => 'ARD', 'phone' => '809-593-5900', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Fuerza Aérea de República Dominicana', 'siglas' => 'FARD', 'phone' => '809-688-3333', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hospital Central de las Fuerzas Armadas', 'siglas' => 'HCFFAA', 'phone' => '809-541-9339.', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Programa de Educación y Capacitación Profesional', 'siglas' => 'PECP', 'phone' => '809-537-2756', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto Militar de Educación Superior', 'siglas' => 'IMES', 'phone' => '809-530-5155', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto Cartográfico Militar', 'siglas' => 'ICM', 'phone' => '809-508-3311', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto Militar de los Derechos Humanos y Derecho Internacional Humanitario', 'siglas' => 'IMDHDIH', 'phone' => '809-508-6219', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Cuerpo Especializado en Seguridad Aeroportuaria y de la Aviación Civil', 'siglas' => 'CESAC', 'phone' => '809-563-0249', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Cuerpo Especializado en Seguridad Portuaria', 'siglas' => 'CESEP', 'phone' => '809-537-0055', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto de Altos Estudios para la Defensa y Seguridad Naciona', 'siglas' => 'IAEDESEN', 'phone' => '809-530-5149', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto de Seguridad Social de las Fuerzas Armadas', 'siglas' => 'ISSFFAA', 'phone' => '809-363-0430', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de Ceremonial y Protocolo Militar y Extranjería Recinto SEFA', 'siglas' => 'DGCPME', 'phone' => '809-530-5149', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de Promoción de las Comunidades Fronterizas', 'siglas' => 'DGPCF', 'phone' => '809-533-6676', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de las Escuelas Vocacionales de las Fuerzas Armadas y la Policía Nacional', 'siglas' => 'DIGEV', 'phone' => '809-535-5240', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Instituto Nacional para la Defensa 27 de Febrero', 'siglas' => 'INADE', 'phone' => '809-531-2971', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General del Servicio Militar Voluntario', 'siglas' => 'SMV', 'phone' => '809-539-5859', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Círculo Deportivo Militar de las Fuerzas Armadas y la Policía Nacional', 'siglas' => 'CONFEDFAPNRD', 'phone' => '809-591-2900', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Comisión Permanente para Reforma de las Fuerzas Armadas y la Policía Nacional', 'siglas' => 'COPREMFA', 'phone' => '809-534-4879', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Superintendencia de Vigilancia y Seguridad Privada', 'siglas' => 'SVSP', 'phone' => '809-566-3116', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de las Reservas de las Fuerzas Armadas', 'siglas' => 'DGRFA', 'phone' => null, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Cuerpo Especializado de Seguridad Fronteriza', 'siglas' => 'CESFRONT', 'phone' => '809-688-6462', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de la Banda de Música de las Fuerzas Armadas', 'siglas' => 'DGBMFA', 'phone' => '809-530-4707', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección de Auditoría General', 'siglas' => 'AGN', 'phone' => '809-539-5827', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Dirección General de la Radioemisora Cultural La Voz de las Fuerzas Armadas', 'siglas' => 'HIFA', 'phone' => '809-530-5163', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Procuraduría General de las Fuerzas Armadas', 'siglas' => 'PGFA', 'phone' => '809-530-2860', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Academia Militar “Batalla de las Carreras” de las Fuerzas Armadas', 'siglas' => 'AMBC', 'phone' => '809-222-2910', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Administradora de Riesgos de Salud de las Fuerzas Armadas', 'siglas' => 'ARS-FFAA', 'phone' => '809-334-3322', 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Junta de Retiros de las Fuerzas Armadas', 'siglas' => 'JRFPFFAA', 'phone' => '809-534-0170', 'created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
