<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\habitacion;

class habitaciones extends Controller
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
            $d = habitacion::all();
            return view('Vistas.muestraHabitaciones')->with('habitaciones',$d);
        }
        else
            return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol == "Administrador")
            return view('Vistas.creaHabitacion');
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
        if (Auth::user()->rol == "Administrador")
        {
            $dato = new habitacion;
            $dato->precio = $request->precio;
            $dato->idTipoHabitacion = $request->idTipoHabitacion;
            $dato->idTipoHotel = $request->idTipoHotel;
            $dato->save();
            return redirect('/habitaciones');
        }
        else
            return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (Auth::user()->rol == "Administrador")
        {
            $dato = habitacion::find($id);
            return view('Vistas.editaHabitacion')->with('habitacion',$dato);
        }
        else
            return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->rol == "Administrador")
        {
            $dato = habitacion::find($id);
            if(!is_null($dato))
            {
                $dato->precio = $request->precio;
                $dato->idTipoHabitacion = $request->idTipoHabitacion;
                $dato->idTipoHotel = $request->idTipoHotel;
                $dato->save();
            }
            return redirect('/habitaciones');
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
            $dato = habitacion::find($id);
            $dato->delete();
            return redirect('/habitaciones');
        }
        else
            return redirect('/');
    }
}
