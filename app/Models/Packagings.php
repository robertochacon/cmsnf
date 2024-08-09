<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packagings extends Model
{
    use HasFactory;

    protected $table = 'packagings';

    protected $fillable = [
        'name'
    ];
}
