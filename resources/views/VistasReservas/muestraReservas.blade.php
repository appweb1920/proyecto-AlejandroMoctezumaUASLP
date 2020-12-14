@extends('layouts.app')

@section('content')
    <h2>Tus Reservas</h2>

    @if(!is_null($reservas))
        @foreach ($reservas as $reserva)  
            <div class = "row">  
                <div class = "col s10 m10 l10 red accent-1 black-text">  
                    <h5>Datos de la Reserva:</h5>
                    <p>Titular: {{$reserva->reservaNombre}} {{$reserva->reservaApellidos}}</p>
                    <p>Total de la Reserva Completa: ${{$reserva->reservaTotal}}</p>
                    <p>Peticiones: {{$reserva->reservaPeticiones}}</p>
                    <h5>Datos de la Habitación:</h5>
                    <p>{{$reserva->hotelNombre}} [{{$reserva->hotelEstrellas}} estrellas] </p>
                    <p>{{$reserva->paisNombre}}, {{$reserva->direccionEstado}}, {{$reserva->direccionCiudad}} [{{$reserva->tipoNombre}}]</p>
                    <p>{{$reserva->direccionCalle}} {{$reserva->direccionNumero}}, C.P. {{$reserva->direccionCodigoPostal}}</p>
                    <p>Horas de Check-In & Check-Out: {{$reserva->hotelCheckIn}} - {{$reserva->hotelCheckOut}}</p>
                    <img class="responsive-img" src="{{asset('/storage/imgs/'. $reserva->habitacionImagen)}}">
                    @if(Auth::user()->rol == 'Administrador' | Auth::user()->rol == 'Usuario')
                        <form action="reservas/{{$reserva->reservaId}}" method="POST" class = "col s12"> 
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
    @endif
@endsection