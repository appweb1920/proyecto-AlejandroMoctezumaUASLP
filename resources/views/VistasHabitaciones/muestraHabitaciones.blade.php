@extends('layouts.app')

@section('content')
    <h2>Habitaciones</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal amber z-depth-1">  
            <a href="/habitaciones/create">Nuevo Habitacion</a>
        </button></td>
    @endif

    @if(!is_null($habitaciones))
        @foreach ($habitaciones as $habitacion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 light-green darken-3 white-text">  
                    <p>{{$habitacion->hotelNombre}} [{{$habitacion->hotelEstrellas}} estrellas] </p>
                    <p>{{$habitacion->paisNombre}}, {{$habitacion->direccionEstado}}, {{$habitacion->direccionCiudad}} [{{$habitacion->tipoNombre}}]</p>
                    <p>{{$habitacion->direccionCalle}} {{$habitacion->direccionNumero}}, C.P. {{$habitacion->direccionCodigoPostal}}</p>
                    <p>[{{$habitacion->hotelCheckIn}} - {{$habitacion->hotelCheckOut}}] ${{$habitacion->habitacionPrecio}}</p>
                    <img src="{{asset('/storage/imgs/'. $habitacion->habitacionImagen)}}">
                    @if(Auth::user()->rol == 'Administrador')
                        <form action="habitaciones/{{$habitacion->habitacionId}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal amber z-depth-1">  
                                <a href="/habitaciones/{{$habitacion->habitacionId}}/edit">Edita</a>
                            </button></td>  
                            <button class = "btn waves-effect waves-teal amber z-depth-1" type="submit" name="action">
                                Borrar
                            </button></td>  
                        </form>
                    @endif
                </div>  
            </div>  
        @endforeach
    @endif
@endsection