<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pais extends Model
{
    use SoftDeletes;
    protected $table="paises";
    protected $fillable=['nombre'];
}