<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{

    protected $table = ('specialties');
    protected $fillable  = [
        'id',
        'name',
        'description'
    ];

    public function users(){

        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
