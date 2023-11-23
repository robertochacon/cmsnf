<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurances extends Model
{
    protected $table = 'insurances';

    protected $fillable = [
        'user_id','name','phone','coverage','status'
    ];
}
