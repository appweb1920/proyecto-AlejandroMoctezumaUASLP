<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\reserva;
use App\Models\carritoHabitacion;
use Illuminate\Support\Facades\Auth;

class reservas extends Controller
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
            $d = DB::table('reservas')
            ->join('habitaciones', 'habitaciones.id', '=', 'reservas.idHabitacion')
            ->join('tipoHabitaciones', 'tipoHabitaciones.id', '=', 'habitaciones.idTipoHabitacion')
            ->join('hoteles', 'hoteles.id', '=', 'habitaciones.idHotel')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'reservas.id AS reservaId',
                'reservas.nombreTitular AS reservaNombre',
                'reservas.apellidosTitular AS reservaApellidos',
                'reservas.peticiones AS reservaPeticiones',
                'reservas.total AS reservaTotal',
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
            ->where('reservas.deleted_at','=',null)
            ->where('reservas.idUsuario','=',Auth::id())
            ->get();
            return view('VistasReservas.muestraReservas')->with('reservas',$d);
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
        if (Auth::user()->rol == "Administrador" || Auth::user()->rol == "Usuario" )
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
                'carritoHabitaciones.checkIn AS checkIn',
                'carritoHabitaciones.checkOut AS checkOut',
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
            
            $r = DB::table('carritoHabitaciones')
            ->join('habitaciones', 'habitaciones.id', '=', 'carritoHabitaciones.idHabitacion')
            ->where('carritoHabitaciones.deleted_at','=',null)
            ->where('carritoHabitaciones.idUsuario','=',Auth::id())
            ->sum('habitaciones.precio');
            
            return view('VistasReservas.creaReserva')
            ->with("habitaciones",$d)
            ->with("total",$r);
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
            $habitaciones = DB::table('carritoHabitaciones')
            ->join('habitaciones', 'habitaciones.id', '=', 'carritoHabitaciones.idHabitacion')
            ->select(
                'carritoHabitaciones.id AS carritoId',
                'carritoHabitaciones.checkIn AS checkIn',
                'carritoHabitaciones.checkOut AS checkOut',
                'habitaciones.id AS habitacionId'
            )
            ->where('carritoHabitaciones.deleted_at','=',null)
            ->where('carritoHabitaciones.idUsuario','=',Auth::id())
            ->get();
            
            $total = DB::table('carritoHabitaciones')
            ->join('habitaciones', 'habitaciones.id', '=', 'carritoHabitaciones.idHabitacion')
            ->where('carritoHabitaciones.deleted_at','=',null)
            ->where('carritoHabitaciones.idUsuario','=',Auth::id())
            ->sum('habitaciones.precio');

            foreach($habitaciones as $habitacion)
            {
                $reserva = new reserva;
                $reserva->checkIn = $habitacion->checkIn;
                $reserva->checkOut = $habitacion->checkOut;
                $reserva->total = $total;
                $reserva->usuarioEsTitular = true;
                $reserva->nombreTitular = $request->nombreTitular;
                $reserva->apellidosTitular = $request->apellidosTitular;
                $reserva->peticiones = $request->peticiones;
                $reserva->idUsuario = Auth::id();
                $reserva->idHabitacion = $habitacion->habitacionId;
                $reserva->save();

                $carrito = carritoHabitacion::find($habitacion->carritoId);
                $carrito->delete();
            }
            return redirect('/reservaConfirmada');
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
        if (Auth::user()->rol == "Administrador" || Auth::user()->rol == "Usuario")
        {
            $dato = reserva::find($id);
            $dato->delete();
            return redirect('/reservas');
        }
        else
            return redirect('/');
    }
}
