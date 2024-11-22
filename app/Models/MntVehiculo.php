<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MntVehiculo extends Model
{
    use HasFactory;

    protected $table = 'mnt_vehiculo';


    protected $fillable = [
        'marca',
        'modelo',
        'año',
        'placa',
        'color',
    ];
}
