<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('checkIn');
            $table->date('checkOut');
            $table->double('total',10,2);
            $table->boolean('usuarioEsTitular');
            $table->string('nombreTitular', 100);
            $table->string('apellidosTitular', 100);
            $table->string('peticiones', 200);
            $table->foreignId('idUsuario')->constrained('users');
            $table->foreignId('idHabitacion')->constrained('habitaciones');
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
        Schema::dropIfExists('reservas');
    }
}
