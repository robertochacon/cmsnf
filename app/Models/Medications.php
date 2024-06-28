<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    use HasFactory;

    protected $table = 'medications';

    protected $fillable = [
        'name',
        'description', // Descripción del medicamento
        'manufacturer', // Fabricante del medicamento
        'dosage', // Dosificación del medicamento
        'price', // Precio del medicamento
        'quantity', // Cantidad en inventario
        'expiry_date', // Fecha de caducidad
        'prescription_required', // Booleano para indicar si se requiere receta
        'active_substance', // Sustancia activa del medicamento
        'storage_conditions', // Condiciones de almacenamiento del medicamento
        // Otros campos relevantes según tus necesidades
    ];

}
