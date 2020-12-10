<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipoHabitacion extends Model
{
    use SoftDeletes;
    protected $table="tipoHabitaciones";
    protected $fillable=['nombre','caracteristicas','imagen01','imagen02','imagen03'];
}