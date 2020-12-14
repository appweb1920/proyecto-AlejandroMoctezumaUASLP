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
        if (Auth::user()->rol == "Administrador" | Auth::user()->rol == "Usuario")
        {
            $d = DB::table('carritoHabitaciones')
            ->join('users', 'users.id', '=', 'carritoHabitaciones.idUsuario')
            ->join('habitaciones', 'habitaciones.id', '=', 'carritoHabitaciones.idHabitacion')
            ->join('tipoHabitaciones', 'tipoHabitaciones.id', '=', 'habitaciones.idTipoHabitacion')
            ->join('hoteles', 'hoteles.id', '=', 'habitaciones.idHotel')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'carritoHabitaciones.id AS productoId',
                'habitaciones.precio AS habitacionPrecio',
                'habitaciones.imagen AS habitacionImagen',
                'tipoHabitaciones.nombre AS tipoNombre',
                'tipoHabitaciones.caracteristicas AS tipoCaracteristicas',
                'hoteles.nombre AS hotelNombre',
                'hoteles.estrellas AS hotelEstrellas',
                'hoteles.horaCheckIn AS hotelCheckIn',
                'hoteles.horaCheckOut AS hotelCheckOut',
                'direcciones.calle AS direccionCalle',
                'direcciones.numero AS direccionNumero',
                'direcciones.ciudad AS direccionCiudad',
                'direcciones.estado AS direccionEstado',
                'direcciones.codigoPostal AS direccionCodigoPostal',
                'paises.nombre AS paisNombre'
            )
            ->where('carritoHabitaciones.deleted_at','=',null)
            ->where('carritoHabitaciones.idUsuario','=',Auth::id())
            ->get();
            return view('VistasCarrito.muestraCarrito')->with('habitaciones',$d);
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
        $dato = new carritoHabitacion;
        $dato->idUsuario = Auth::id();
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
