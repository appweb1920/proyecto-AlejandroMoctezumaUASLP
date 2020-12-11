<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\hotel;
use Illuminate\Support\Facades\Auth;

class hoteles extends Controller
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
            $d = hotel::all();
            return view('VistasHoteles.muestraHoteles')->with('hoteles',$d);
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
            return view('VistasHoteles.creaHotel');
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
            $dato = new hotel;
            $dato->nombre = $request->nombre;
            $dato->estrellas = $request->estrellas;
            $dato->horaCheckIn = $request->horaCheckIn;
            $dato->horaCheckOut = $request->horaCheckOut;
            $dato->idDireccion = $request->idDireccion;
            $dato->save();
            return redirect('/hoteles');
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
            $dato = hotel::find($id);
            return view('VistasHoteles.editaHotel')->with('hotel',$dato);
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
            $dato = hotel::find($id);
            if(!is_null($dato))
            {
                $dato->nombre = $request->nombre;
                $dato->estrellas = $request->estrellas;
                $dato->horaCheckIn = $request->horaCheckIn;
                $dato->horaCheckOut = $request->horaCheckOut;
                $dato->idDireccion = $request->idDireccion;
                $dato->save();
            }
            return redirect('/hoteles');
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
            $dato = hotel::find($id);
            $dato->delete();
            return redirect('/hoteles');
        }
        else
            return redirect('/');
    }
}
