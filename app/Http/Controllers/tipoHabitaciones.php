<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\tipoHabitacion;

class tipoHabitaciones extends Controller
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
            $d = tipoHabitacion::all();
            return view('VistasTipoHabitaciones.muestraTipoHabitaciones')->with('tipoHabitaciones',$d);
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
            return view('VistasTipoHabitaciones.creaTipoHabitacion');
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
            $dato = new tipoHabitacion;
            $dato->nombre = $request->nombre;
            $dato->caracteristicas = $request->caracteristicas;
            $dato->imagen01 = $request->imagen01;
            $dato->imagen02 = $request->imagen02;
            $dato->imagen03 = $request->imagen03;
            $dato->save();
            return redirect('/tipoHabitaciones');
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
            $dato = tipoHabitacion::find($id);
            return view('VistasTipoHabitaciones.editaTipoHabitacion')->with('tipoHabitacion',$dato);
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
            $dato = tipoHabitacion::find($id);
            if(!is_null($dato))
            {
                $dato->nombre = $request->nombre;
                $dato->caracteristicas = $request->caracteristicas;
                $dato->imagen01 = $request->imagen01;
                $dato->imagen02 = $request->imagen02;
                $dato->imagen03 = $request->imagen03;
                $dato->save();
            }
            return redirect('/tipoHabitaciones');
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
            $dato = tipoHabitacion::find($id);
            $dato->delete();
            return redirect('/tipoHabitaciones');
        }
        else
            return redirect('/');
    }
}
