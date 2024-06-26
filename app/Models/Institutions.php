<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institutions extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $fillable = [
        'id','name','siglas','phone','status'
    ];
}
