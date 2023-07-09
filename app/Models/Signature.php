<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [

        'id',
        'doctor',
        'paciente',
        'procedureType',
        'tratamiento',
        'fecha',
        'hora',
        'indicaciones',
        'signature',
        'cedula1',
        'signature2',
        'cedula2',
        'appointment_id'
    ];

}
