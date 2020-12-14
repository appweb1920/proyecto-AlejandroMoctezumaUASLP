@extends('layouts.app')

@section('content')
    <h2>Tu Carrito</h2>

    @if(!is_null($habitaciones))
        @foreach ($habitaciones as $habitacion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 red accent-1 black-text">  
                    <p>{{$habitacion->hotelNombre}} [{{$habitacion->hotelEstrellas}} estrellas] </p>
                    <p>{{$habitacion->paisNombre}}, {{$habitacion->direccionEstado}}, {{$habitacion->direccionCiudad}} [{{$habitacion->tipoNombre}}]</p>
                    <p>{{$habitacion->direccionCalle}} {{$habitacion->direccionNumero}}, C.P. {{$habitacion->direccionCodigoPostal}}</p>
                    <p>[{{$habitacion->hotelCheckIn}} - {{$habitacion->hotelCheckOut}}] ${{$habitacion->habitacionPrecio}}</p>
                    <img class="responsive-img" src="{{asset('/storage/imgs/'. $habitacion->habitacionImagen)}}">
                    @if(Auth::user()->rol == 'Administrador' | Auth::user()->rol == 'Usuario')
                        <form action="carrito/{{$habitacion->productoId}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1" type="submit" name="action">
                                Eliminar
                            </button></td>  
                        </form>
                    @endif
                </div>  
            </div>  
        @endforeach

        @if (count($habitaciones) > 0)
            <button class = "btn waves-effect waves-teal purple accent-1 z-depth-1">  
                <a href="/reservas/create">Hacer Reservación</a>
            </button></td>
        @else
            <h3>Tu carrito está vacio</h3>
        @endif
    @endif
@endsection