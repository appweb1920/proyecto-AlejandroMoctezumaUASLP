<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\carritoHabitacion;
use Illuminate\Support\Facades\Auth;

class carritoHabitaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = carritoHabitacion::all();
        return view('VistasCarrito.muestraCarrito')->with('carrito',$d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dato = new carritoHabitacion;
        $dato->idUsuario = $request->idUsuario;
        $dato->idHabitacion = $request->idHabitacion;
        $dato->save();
        return redirect('/carrito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = carritoHabitacion::find($id);
        $dato->delete();
        return redirect('/carrito');
    }
}
