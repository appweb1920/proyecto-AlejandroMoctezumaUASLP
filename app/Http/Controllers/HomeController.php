<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function portada()
    {
        $fechaInicio = Carbon::now();
        $fechaFin = Carbon::now()->addDays(2);
        return view('Vistas.portada')
        ->with("limiteCheckIn",$fechaInicio)
        ->with("limiteCheckOut",$fechaFin);
    }

    /**
     * Pantalla mostrada al hacer una reservación
     *
     * @return void
     */
    public function reservaConfirmada()
    {
        return view('Vistas.reservacionExitosa');
    }
}
