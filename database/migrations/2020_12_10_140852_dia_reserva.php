<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiaReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaReservas', function (Blueprint $table) {
            $table->id();
            $table->date('dia');
            $table->foreignId('idUsuario')->constrained('users');
            $table->foreignId('idHabitacion')->constrained('habitaciones');
            $table->foreignId('idReserva')->constrained('reservas');
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
        Schema::dropIfExists('diaReservas');
    }
}
