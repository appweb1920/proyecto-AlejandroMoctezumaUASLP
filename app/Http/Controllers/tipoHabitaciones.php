<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\tipoHabitacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class tipoHabitaciones extends Controller
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
            $d = tipoHabitacion::all();
            return view('VistasTipoHabitaciones.muestraTipoHabitaciones')->with('tipoHabitaciones',$d);
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
            return view('VistasTipoHabitaciones.creaTipoHabitacion');
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
            $dato = new tipoHabitacion;
            $dato->nombre = $request->nombre;
            $dato->caracteristicas = $request->caracteristicas;

            $archivo = $request->file('imagen01');
            $request->file('imagen01')->storeAs(
                    "public/imgs", $dato->nombre . "01." . $archivo->getClientOriginalExtension()
            );
            $dato->imagen01 = $dato->nombre . "01." . $archivo->getClientOriginalExtension();

            $archivo = $request->file('imagen02');
            $request->file('imagen02')->storeAs(
                    "public/imgs", $dato->nombre . "02." . $archivo->getClientOriginalExtension()
            );
            $dato->imagen02 = $dato->nombre . "02." . $archivo->getClientOriginalExtension();

            $archivo = $request->file('imagen03');
            $request->file('imagen03')->storeAs(
                    "public/imgs", $dato->nombre . "03." . $archivo->getClientOriginalExtension()
            );
            $dato->imagen03 = $dato->nombre . "03." . $archivo->getClientOriginalExtension();

            $dato->save();
            return redirect('/tipoHabitaciones');
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
            $dato = tipoHabitacion::find($id);
            return view('VistasTipoHabitaciones.editaTipoHabitacion')->with('tipoHabitacion',$dato);
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
            $dato = tipoHabitacion::find($id);
            if(!is_null($dato))
            {
                $dato->nombre = $request->nombre;
                $dato->caracteristicas = $request->caracteristicas;

                if(!is_null($request->imagen01))
                {
                    File::delete('storage/imgs/'. $dato->imagen01);
                    $archivo = $request->file('imagen01');
                    $request->file('imagen01')->storeAs(
                            "public/imgs", $dato->nombre . "01." . $archivo->getClientOriginalExtension()
                    );
                    $dato->imagen01 = $dato->nombre . "01." . $archivo->getClientOriginalExtension();
                }

                if(!is_null($request->imagen02))
                {
                    File::delete('storage/imgs/'. $dato->imagen02);
                    $archivo = $request->file('imagen02');
                    $request->file('imagen02')->storeAs(
                            "public/imgs", $dato->nombre . "02." . $archivo->getClientOriginalExtension()
                    );
                    $dato->imagen02 = $dato->nombre . "02." . $archivo->getClientOriginalExtension();
                }

                if(!is_null($request->imagen03))
                {
                    File::delete('storage/imgs/'. $dato->imagen03);
                    $archivo = $request->file('imagen03');
                    $request->file('imagen03')->storeAs(
                            "public/imgs", $dato->nombre . "03." . $archivo->getClientOriginalExtension()
                    );
                    $dato->imagen03 = $dato->nombre . "03." . $archivo->getClientOriginalExtension();
                }
                $dato->save();
            }
            return redirect('/tipoHabitaciones');
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
            $dato = tipoHabitacion::find($id);

            if(File::exists('storage/imgs/'. $dato->imagen01)) {
                File::delete('storage/imgs/'. $dato->imagen01);
            }

            if(File::exists('storage/imgs/'. $dato->imagen02)) {
                File::delete('storage/imgs/'. $dato->imagen02);
            }

            if(File::exists('storage/imgs/'. $dato->imagen03)) {
                File::delete('storage/imgs/'. $dato->imagen03);
            }

            $dato->delete();
            return redirect('/tipoHabitaciones');
        }
        else
            return redirect('/');
    }
}
