<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultations extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $fillable = [
        'id','user_id','patient_id','ta','fc','fr','reason','counter_referral','hea','physical_exam','complementary_studies','diagnosis','treatment','status','note'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

}
