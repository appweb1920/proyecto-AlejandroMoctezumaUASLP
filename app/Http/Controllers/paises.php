<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\pais;

class paises extends Controller
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
            $d = pais::all();
            return view('VistasPaises.muestraPaises')->with('paises',$d);
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
            return view('VistasPaises.creaPais');
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
            $dato = new pais;
            $dato->nombre = $request->nombre;
            $dato->save();
            return redirect('/paises');
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
            $dato = pais::find($id);
            return view('VistasPaises.editaPais')->with('pais',$dato);
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
            $dato = pais::find($id);
            if(!is_null($dato))
            {
                $dato->nombre = $request->nombre;
                $dato->save();
            }
            return redirect('/paises');
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
            $dato = pais::find($id);
            $dato->delete();
            return redirect('/paises');
        }
        else
            return redirect('/');
    }
}
