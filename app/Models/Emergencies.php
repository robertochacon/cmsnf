<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergencies extends Model
{
    protected $table = 'emergencies';

    protected $fillable = [
        'user_id','patient_id','identification','reason','background', 'ta', 'fc','fr','temp','physical_exam','observations','laboratory','diagnosis','plan','medicine','details','Transfer','status'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Models\Patients', 'patient_id');
    }
}
