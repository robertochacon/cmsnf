<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    protected $table = 'licenses';

    protected $fillable = [
        'user_id','name', 'identification', 'age','phone','range','address','days','diagnostic','status'
    ];
}
