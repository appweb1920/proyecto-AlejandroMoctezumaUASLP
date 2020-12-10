<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class carritoHabitacion extends Model
{
    use SoftDeletes;
    protected $table="carritoHabitaciones";
    protected $fillable=['idUsuario','idHabitacion'];
}