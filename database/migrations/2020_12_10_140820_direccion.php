<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Direccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 100);
            $table->string('numero', 100);
            $table->string('ciudad', 100);
            $table->string('estado', 100);
            $table->string('codigoPostal', 100);
            $table->foreignId('idPais')->constrained('pais');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
