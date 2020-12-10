<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarritoHabitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carritoHabitaciones', function (Blueprint $table) {
            $table->foreignId('idUsuario')->constrained('users');
            $table->foreignId('idHabitacion')->constrained('habitacion');
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
        Schema::dropIfExists('carritoHabitaciones');
    }
}