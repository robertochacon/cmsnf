<?php

namespace Database\Seeders;

use App\Models\Medications as ModelsMedications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Medications extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMedications::create([
            'supplier_id' => null,
            'name' => 'Paracetamol',
            'description' => 'Analgésico y antipirético',
            'manufacturer' => 'Pharma Corp',
            'dosage' => '500mg',
            'price' => 10.00,
            'quantity' => 100,
            'expiry_date' => '2025-12-31',
            'prescription_required' => false,
            'active_substance' => 'Paracetamol',
            'storage_conditions' => 'Almacenar a temperatura ambiente',
        ]);

        ModelsMedications::create([
            'supplier_id' => null,
            'name' => 'Ibuprofeno',
            'description' => 'Antiinflamatorio no esteroideo',
            'manufacturer' => 'HealthMed Inc.',
            'dosage' => '200mg',
            'price' => 12.50,
            'quantity' => 150,
            'expiry_date' => '2026-06-30',
            'prescription_required' => true,
            'active_substance' => 'Ibuprofeno',
            'storage_conditions' => 'Mantener en lugar fresco y seco',
        ]);
    }
}
