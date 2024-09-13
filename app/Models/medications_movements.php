<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications_movements extends Model
{
    use HasFactory;

    protected $table = 'medications_movements';

    protected $fillable = [
        'medication_id',
        'quantity',
        'status',
    ];

    public function medication()
    {
    	return $this->belongsTo('App\Models\Medications', 'medication_id');
    }

}
