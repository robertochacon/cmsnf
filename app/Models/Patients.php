<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'user_id', 'sexo', 'institution', 'name', 'identification', 'age','phone','range','address','allergic','blood','have_parent','parent_range','parent_name','parent_intitution','apf','app'
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
