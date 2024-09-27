<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationsMovements extends Model
{
    use HasFactory;

    protected $table = 'medications_movements';

    protected $fillable = [
        'medication_id',
        'patient_id',
        'quantity',
        'status',
    ];

    public function medication()
    {
    	return $this->belongsTo('App\Models\Medications', 'medication_id');
    }

}
