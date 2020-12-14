<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\hotel;
use App\Models\direccion;
use App\Models\pais;
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
            $d = DB::table('hoteles')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'hoteles.id AS hotelId',
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
            ->where('hoteles.deleted_at','=',null)
            ->get();
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
        {
            $d = pais::all();
            return view('VistasHoteles.creaHotel')->with('paises',$d);
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
            $direccion = new direccion;
            $direccion->calle = $request->calle;
            $direccion->numero = $request->numero;
            $direccion->ciudad = $request->ciudad;
            $direccion->estado = $request->estado;
            $direccion->codigoPostal = $request->codigoPostal;
            $direccion->idPais = $request->idPais;
            $direccion->save();

            $hotel = new hotel;
            $hotel->nombre = $request->nombre;
            $hotel->estrellas = $request->estrellas;
            $hotel->horaCheckIn = $request->horaCheckIn;
            $hotel->horaCheckOut = $request->horaCheckOut;
            $hotel->idDireccion = $direccion->id;
            $hotel->save();

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
            $d = DB::table('hoteles')
            ->join('direcciones', 'direcciones.id', '=', 'hoteles.idDireccion')
            ->join('paises', 'paises.id', '=', 'direcciones.idPais')
            ->select(
                'hoteles.id AS hotelId',
                'hoteles.nombre AS hotelNombre',
                'hoteles.estrellas AS hotelEstrellas',
                'hoteles.horaCheckIn AS hotelCheckIn',
                'hoteles.horaCheckOut AS hotelCheckOut',
                'direcciones.id AS direccionId',
                'direcciones.calle AS direccionCalle',
                'direcciones.numero AS direccionNumero',
                'direcciones.ciudad AS direccionCiudad',
                'direcciones.estado AS direccionEstado',
                'direcciones.codigoPostal AS direccionCodigoPostal',
                'paises.nombre AS paisNombre'
            )
            ->where('hoteles.id','=',$id)
            ->get();
            $r = pais::all();
            return view('VistasHoteles.editaHotel')
            ->with('hotel',$d)
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
            $hotel = hotel::find($id);
            $direccion = direccion::find($request->direccionId);
            if(!is_null($hotel) & !is_null($direccion))
            {
                $direccion->calle = $request->calle;
                $direccion->numero = $request->numero;
                $direccion->ciudad = $request->ciudad;
                $direccion->estado = $request->estado;
                $direccion->codigoPostal = $request->codigoPostal;
                $direccion->idPais = $request->idPais;
                $direccion->save();

                $hotel->nombre = $request->nombre;
                $hotel->estrellas = $request->estrellas;
                $hotel->horaCheckIn = $request->horaCheckIn;
                $hotel->horaCheckOut = $request->horaCheckOut;
                $hotel->idDireccion = $direccion->id;
                $hotel->save();
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
