<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class direccion extends Model
{
    use SoftDeletes;
    protected $table="direcciones";
    protected $fillable=['calle','numero','ciudad','estado','codigoPostal','idPais'];
}