<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalConsultations extends Model
{
    protected $table = 'medical_consultations';

    protected $fillable = [
        'user_id','patient_id','identification','reason','background', 'ta', 'fc','fr','temp','physical_exam','observations','laboratory','diagnosis','plan','medicine','details','Transfer','type','status'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Models\Patients', 'patient_id');
    }
}
