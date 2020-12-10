<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class diaReserva extends Model
{
    use SoftDeletes;
    protected $table="diaReservas";
    protected $fillable=['dia','idUsuario','idHabitacion','idReserva'];
}