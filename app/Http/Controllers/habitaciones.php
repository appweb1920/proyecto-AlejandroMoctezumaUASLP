<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\habitacion;
use App\Models\hotel;
use App\Models\tipoHabitacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class habitaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol == "Administrador" || Auth::user()->rol == "Usuario")
        {
            $d = DB::table('habitaciones')
            ->join('tipoHabitaciones', 'tipoHabitaciones.id', '=', 'habitaciones.idTipoHabitacion')
            ->join('hoteles', 'hoteles.id', '=', 'habitaciones.idHotel')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'habitaciones.id AS habitacionId',
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
            ->where('habitaciones.deleted_at','=',null)
            ->get();
            return view('VistasHabitaciones.muestraHabitaciones')->with('habitaciones',$d);
        }
        else
            return redirect('/');
    }

    /**
     * Display a listing of the resource with a filter applied
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexFiltro(Request $request)
    {
        if (Auth::user()->rol == "Administrador" || Auth::user()->rol == "Usuario")
        {
            $d = DB::table('habitaciones')
            ->join('tipoHabitaciones', 'tipoHabitaciones.id', '=', 'habitaciones.idTipoHabitacion')
            ->join('hoteles', 'hoteles.id', '=', 'habitaciones.idHotel')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'habitaciones.id AS habitacionId',
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
            ->where('habitaciones.deleted_at','=',null)
            ->whereNotIn('habitaciones.id',function($q){
                $q->select('idHabitacion')
                ->from('carritoHabitaciones')
                ->where('carritoHabitaciones.deleted_at','=',null);
            })
            ->whereNotIn('habitaciones.id',function($q) use ($request) {
                $q->select('habitaciones.id')
                ->from('habitaciones')
                ->join('reservas', 'reservas.idHabitacion', '=', 'habitaciones.id')
                ->whereNotIn('habitaciones.id',function($r) use ($request) {
                    $r->select('idHabitacion')
                    ->from('reservas')
                    ->where(function($j) use ($request) {
                        $j->where('reservas.checkIn', '>', $request->checkIn)
                        ->where('reservas.checkIn', '>=', $request->checkOut)
                        ->where('reservas.deleted_at','=',null);
                    })
                    ->orwhere(function($j) use ($request) {
                        $j->where('reservas.checkOut', '<=', $request->checkIn)
                        ->where('reservas.checkOut', '<', $request->checkOut)
                        ->where('reservas.deleted_at','=',null);
                    });
                });
            })
            ->orderBy('habitaciones.precio','asc')
            ->get();
            return view('VistasHabitaciones.muestraHabitaciones')
            ->with('habitaciones',$d)
            ->with('fechas',$request);
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
            $d = hotel::all();
            $r = tipoHabitacion::all();
            return view('VistasHabitaciones.creaHabitacion')
            ->with('hoteles',$d)
            ->with('tipoHabitaciones',$r);
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
            if(is_null($request->file('imagen')))
            {
                return redirect()->back()->withErrors(["error"=>"Hay que incluir una imagen"])->withInput();
            }

            $dato = new habitacion;
            $dato->precio = $request->precio;
            $dato->idTipoHabitacion = $request->idTipoHabitacion;
            $dato->idHotel = $request->idHotel;
            $dato->imagen = "";
            $dato->save();

            $archivo = $request->file('imagen');
            $request->file('imagen')->storeAs(
                    "public/imgs", $dato->id . "." . $archivo->getClientOriginalExtension()
            );
            $dato->imagen = $dato->id . "." . $archivo->getClientOriginalExtension();
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
            $d = DB::table('habitaciones')
            ->select(
                'habitaciones.id',
                'habitaciones.precio',
                'habitaciones.idTipoHabitacion',
                'habitaciones.idHotel'
            )
            ->where('habitaciones.id','=',$id)
            ->get();;
            $r = hotel::all();
            $j = tipoHabitacion::all();
            return view('VistasHabitaciones.editaHabitacion')
            ->with('habitacion',$d)
            ->with('hoteles',$r)
            ->with('tipoHabitaciones',$j);
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
                $dato->idHotel = $request->idHotel;

                if(!is_null($request->imagen))
                {
                    File::delete('storage/imgs/'. $dato->imagen);
                    $archivo = $request->file('imagen');
                    $request->file('imagen')->storeAs(
                            "public/imgs", $dato->id . "." . $archivo->getClientOriginalExtension()
                    );
                    $dato->imagen = $dato->id . "." . $archivo->getClientOriginalExtension();
                }

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

            if(File::exists('storage/imgs/'. $dato->imagen)) {
                File::delete('storage/imgs/'. $dato->imagen);
            }

            $dato->delete();
            return redirect('/habitaciones');
        }
        else
            return redirect('/');
    }
}
