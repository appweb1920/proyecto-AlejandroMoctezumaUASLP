@extends('layouts.app')

@section('content')
    <h2>Hoteles</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal amber z-depth-1">  
            <a href="/hoteles/create">Nuevo Hotel</a>
        </button></td>
    @endif

    @if(!is_null($hoteles))
        @foreach ($hoteles as $hotel)  
            <div class = "row">  
                <div class = "col s10 m10 l10 light-green darken-3 white-text">  
                    <p>[{{$hotel->hotelEstrellas}} estrellas] {{$hotel->hotelNombre}}</p>
                    <p>[{{$hotel->hotelCheckIn}} - {{$hotel->hotelCheckOut}}]</p>
                    <p>{{$hotel->direccionCalle}}, {{$hotel->direccionNumero}} [{{$hotel->direccionCodigoPostal}}]</p>
                    <p>{{$hotel->direccionCiudad}}, {{$hotel->direccionEstado}}, {{$hotel->paisNombre}}</p>
                    @if(Auth::user()->rol == 'Administrador')
                        <form action="hoteles/{{$hotel->hotelId}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal amber z-depth-1">  
                                <a href="/hoteles/{{$hotel->hotelId}}/edit">Edita</a>
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