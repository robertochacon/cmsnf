<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    protected $table = 'prescriptions';

    protected $fillable = [
        'user_id','patient_id','description'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}
