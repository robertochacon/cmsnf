<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    use HasFactory;

    protected $table = 'medications';

    protected $fillable = [
        'supplier_id',
        'name',
        'description',
        'manufacturer',
        'dosage',
        'price',
        'quantity',
        'expiry_date',
        'prescription_required',
        'active_substance',
        'storage_conditions',
    ];

    public function movements()
    {
    	return $this->hasMany('App\Models\MedicationsMovements', 'medication_id');
    }

}
