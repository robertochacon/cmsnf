<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $casts = [
        'child' => 'array',
        'military_family' => 'array',
        'history' => 'array',
    ];

    protected $fillable = [
        'user_id', 'sexo', 'institution_id', 'military', 'younger', 'name', 'identification', 'age','phone','range','address','blood','child','military_family','history'
    ];

    public function consultations()
    {
    	return $this->hasMany('App\Models\Consultations', 'patient_id');
    }

    public function prescriptions()
    {
    	return $this->hasMany('App\Models\Prescriptions', 'patient_id');
    }

    public function licences()
    {
    	return $this->belongsTo('App\Models\Licenses', 'patient_id');
    }
}
