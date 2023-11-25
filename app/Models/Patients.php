<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $casts = [
        'military_family' => 'array',
        'history' => 'array',
    ];

    protected $fillable = [
        'user_id', 'sexo', 'institution', 'name', 'identification', 'age','phone','range','address','blood','military_family','history'
    ];

    public function medicalconsultations()
    {
    	return $this->belongsTo('App\Models\MedicalConsultations', 'patient_id');
    }

    public function licences()
    {
    	return $this->belongsTo('App\Models\Licenses', 'patient_id');
    }
}
