<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\reserva;
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
            ->where('idUsuario','=',Auth::id())
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
            return view('VistasReservas.creaReserva')->with("reservas",$d);
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
            $dato = new reserva;
            $dato->checkIn = $request->checkIn;
            $dato->checkOut = $request->checkOut;
            $dato->total = $request->total;
            $dato->pago = $request->pago;
            $dato->usuarioEsTitular = $request->usuarioEsTitular;
            $dato->nombreTitular = $request->nombreTitular;
            $dato->apellidosTitular = $request->apellidosTitular;
            $dato->peticiones = $request->peticiones;
            $dato->idUsuario = $request->idUsuario;
            $dato->save();
            return redirect('/reservaConfirmada');
        }
        else
            return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->rol == "Administrador")
        {
            $dato = reserva::find($id);
            return view('VistasReservas.muestraReserva')->with('reserva',$dato);
        }
        else if (Auth::user()->rol == "Usuario")
        {
            $dato = reserva::find($id);
            if ($dato->idUsuario == Auth::id())
                return view('VistasReservas.muestraReserva')->with('reserva',$dato);
            else
                return redirect('/');
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
            $dato = reserva::find($id);
            return view('VistasReservas.editaReserva')->with('reserva',$dato);
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
            $dato = reserva::find($id);
            if(!is_null($dato))
            {
                $dato->checkIn = $request->checkIn;
                $dato->checkOut = $request->checkOut;
                $dato->total = $request->total;
                $dato->pago = $request->pago;
                $dato->usuarioEsTitular = $request->usuarioEsTitular;
                $dato->nombreTitular = $request->nombreTitular;
                $dato->apellidosTitular = $request->apellidosTitular;
                $dato->peticiones = $request->peticiones;
                $dato->idUsuario = $request->idUsuario;
                $dato->save();
            }
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
            $dato = reserva::find($id);
            $dato->delete();
            return redirect('/reservas');
        }
        else
            return redirect('/');
    }
}
