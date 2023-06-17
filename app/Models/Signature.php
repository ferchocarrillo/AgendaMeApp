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
        'tratamiento',
        'fecha',
        'indicaciones',
        'signature',
        'signature2',
        'appointment_id'
    ];

}
