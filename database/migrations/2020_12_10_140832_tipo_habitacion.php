<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoHabitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoHabitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('caracteristicas', 200);
            $table->string('imagen01', 100);
            $table->string('imagen02', 100);
            $table->string('imagen03', 100);
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
        Schema::dropIfExists('tipoHabitaciones');
    }
}
