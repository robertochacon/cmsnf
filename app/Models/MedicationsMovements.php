<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationsMovements extends Model
{
    use HasFactory;

    protected $table = 'medications_movements';

    protected $fillable = [
        'medication_ids',
        'patient_id',
        'quantity',
        'type',
        'note',
    ];

    protected $casts = [
        'medication_ids' => 'array',
    ];

    public function getTypeNameAttribute(){
        return $this->type == 'in' ? 'Entrada' : 'Salida';
    }

    public function getMedicationNamesAttribute()
    {
        return Medications::whereIn('id', $this->medication_ids)->pluck('name')->toArray();
    }

    public function patient()
    {
    	return $this->belongsTo('App\Models\Patients', 'patient_id');
    }

}
