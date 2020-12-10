<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Habitacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->id();
            $table->double('precio',8,2);
            $table->foreignId('idTipoHabitacion')->constrained('tipoHabitacion');
            $table->foreignId('idHotel')->constrained('hotel');
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
        Schema::dropIfExists('habitacion');
    }
}
