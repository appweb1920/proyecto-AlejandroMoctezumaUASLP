<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hotel extends Model
{
    use SoftDeletes;
    protected $table="hoteles";
    protected $fillable=['nombre','estrellas','horaCheckIn','horaCheckOut','idDireccion'];
}