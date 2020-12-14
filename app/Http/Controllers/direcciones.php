<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\direccion;
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
}
