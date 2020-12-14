@extends('layouts.app')

@section('content')
    <h2>Habitaciones</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal purple accent-1 z-depth-1">  
            <a href="/habitaciones/create">Nuevo Habitacion</a>
        </button></td>
    @endif

    @if(!is_null($habitaciones))
        @foreach ($habitaciones as $habitacion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 red accent-1 black-text">  
                    <p>${{$habitacion->habitacionPrecio}} | {{$habitacion->hotelNombre}} [{{$habitacion->hotelEstrellas}} estrellas] </p>
                    <p>{{$habitacion->paisNombre}}, {{$habitacion->direccionEstado}}, {{$habitacion->direccionCiudad}} [{{$habitacion->tipoNombre}}]</p>
                    <p>{{$habitacion->direccionCalle}} {{$habitacion->direccionNumero}}, C.P. {{$habitacion->direccionCodigoPostal}}</p>
                    <p>[{{$habitacion->hotelCheckIn}} - {{$habitacion->hotelCheckOut}}]</p>
                    <img class="responsive-img" src="{{asset('/storage/imgs/'. $habitacion->habitacionImagen)}}">
                    @if(Auth::user()->rol == 'Administrador' | Auth::user()->rol == 'Usuario')
                        @isset($fechas)
                            <form action="carrito" method="POST" class = "col s12"> 
                                @csrf
                                <input type="hidden" name="idHabitacion" value="{{$habitacion->habitacionId}}">
                                <input type="hidden" name="checkIn" value="{{$fechas->checkIn}}">
                                <input type="hidden" name="checkOut" value="{{$fechas->checkOut}}">
                                <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1" type="submit" name="action">
                                    Apartar
                                </button></td>  
                            </form>
                        @endisset
                    @endif
                    @if(Auth::user()->rol == 'Administrador')
                        @empty($fechas)
                            <form action="habitaciones/{{$habitacion->habitacionId}}" method="POST" class = "col s12"> 
                            @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1">  
                                    <a href="/habitaciones/{{$habitacion->habitacionId}}/edit">Edita</a>
                                </button></td>  
                                <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1" type="submit" name="action">
                                    Borrar
                                </button></td>  
                            </form>
                        @endempty
                    @endif
                </div>  
            </div>  
        @endforeach
    @endif
@endsection