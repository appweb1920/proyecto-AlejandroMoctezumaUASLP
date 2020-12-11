<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\diaReserva;

class diaReservas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol == "Administrador")
        {
            $d = diaReserva::all();
            return view('Vistas.muestraReservas')->with('reservas',$d);
        }
        else
            return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->rol == "Administrador" || Auth::user()->rol == "Usuario" )
        {
            $dato = new diaReserva;
            $dato->dia = $request->dia;
            $dato->idUsuario = $request->idUsuario;
            $dato->idHabitacion = $request->idHabitacion;
            $dato->idReserva = $request->idReserva;
            $dato->save();
            return redirect('/reservas');
        }
        else
            return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->rol == "Administrador")
        {
            $dato = diaReserva::find($id);
            $dato->delete();
            return redirect('/reservas');
        }
        else
            return redirect('/');
    }
}
