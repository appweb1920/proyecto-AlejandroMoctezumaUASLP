<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\direccion;
use App\Models\pais;
use Illuminate\Support\Facades\Auth;

class direcciones extends Controller
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
            $d = DB::table('direcciones')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'direcciones.id',
                'direcciones.calle',
                'direcciones.numero',
                'direcciones.codigoPostal',
                'direcciones.ciudad',
                'direcciones.estado',
                'paises.nombre'
            )
            ->where('direcciones.deleted_at','=',null)
            ->get();
            return view('VistasDirecciones.muestraDirecciones')->with('direcciones',$d);
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
        {
            $d = pais::all();
            return view('VistasDirecciones.creaDireccion')->with('paises',$d);
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
        if (Auth::user()->rol == "Administrador")
        {
            $dato = new direccion;
            $dato->calle = $request->calle;
            $dato->numero = $request->numero;
            $dato->ciudad = $request->ciudad;
            $dato->estado = $request->estado;
            $dato->codigoPostal = $request->codigoPostal;
            $dato->idPais = $request->idPais;
            $dato->save();
            return redirect('/direcciones');
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
            $d = DB::table('direcciones')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'direcciones.id',
                'direcciones.calle',
                'direcciones.numero',
                'direcciones.codigoPostal',
                'direcciones.ciudad',
                'direcciones.estado',
                'paises.nombre'
            )
            ->where('direcciones.id','=',$id)
            ->get();
            $r = DB::table('paises')
            ->select(
                'paises.id',
                'paises.nombre'
            )
            ->get();
            //return dd($d,$r);
            return view('VistasDirecciones.editaDireccion')
            ->with('direccion',$d)
            ->with('paises',$r);
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
            $dato = direccion::find($id);
            if(!is_null($dato))
            {
                $dato->calle = $request->calle;
                $dato->numero = $request->numero;
                $dato->ciudad = $request->ciudad;
                $dato->estado = $request->estado;
                $dato->codigoPostal = $request->codigoPostal;
                $dato->idPais = $request->idPais;
                $dato->save();
            }
            return redirect('/direcciones');
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
            $dato = direccion::find($id);
            $dato->delete();
            return redirect('/direcciones');
        }
        else
            return redirect('/');
    }
}
