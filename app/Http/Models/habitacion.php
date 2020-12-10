<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class habitacion extends Model
{
    use SoftDeletes;
    protected $table="habitaciones";
    protected $fillable=['precio','idTipoHabitacion','idHotel'];
}