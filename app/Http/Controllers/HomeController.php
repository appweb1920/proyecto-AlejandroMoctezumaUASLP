<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('Vistas.portada');
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
