<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergencies extends Model
{
    protected $table = 'emergencies';

    protected $fillable = [
        'user_id','patient_id','identification','name','reason','background', 'ta', 'fc','fr','temp','physical_exam','observations','laboratory','diagnosis','plan','medicine','details','status','hospital_transfer','reason_transfer'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Models\Patients', 'patient_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}
