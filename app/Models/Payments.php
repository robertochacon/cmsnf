<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'user_id','department_id','identification','name','insurance_id','nss','description','coverage','cost','total','type','to'
    ];
}
