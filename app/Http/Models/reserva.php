<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reserva extends Model
{
    use SoftDeletes;
    protected $table="reservas";
    protected $fillable=['checkIn','checkOut','total','usuarioEsTitular','nombreTitular','apellidosTitular','peticiones','idUsuario','idHabitacion'];
}