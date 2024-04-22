<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    protected $table = 'licenses';

    protected $fillable = [
        'user_id','identification','name','phone','range','address','days','diagnostic','date_start','date_end','status','open','note'
    ];
}
