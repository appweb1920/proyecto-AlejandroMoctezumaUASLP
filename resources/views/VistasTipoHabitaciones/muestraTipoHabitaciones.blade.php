@extends('layouts.app')

@section('content')
    <h2>Tipo de Habitaciones</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal purple accent-1 z-depth-1">  
            <a href="/tipoHabitaciones/create">Nuevo Tipo de Habitacion</a>
        </button></td>
    @endif

    @if(!is_null($tipoHabitaciones))
        @foreach ($tipoHabitaciones as $tipoHabitacion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 red accent-1 black-text">  
                    <p>[{{$tipoHabitacion->nombre}}]</p>
                    <p>{{$tipoHabitacion->caracteristicas}}</p>
                    @if(Auth::user()->rol == 'Administrador')
                        <form action="tipoHabitaciones/{{$tipoHabitacion->id}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1">  
                                <a href="/tipoHabitaciones/{{$tipoHabitacion->id}}/edit">Edita</a>
                            </button></td>  
                            <button class = "btn waves-effect waves-teal orange accent-1 black-text z-depth-1" type="submit" name="action">
                                Borrar
                            </button></td>  
                        </form>
                    @endif
                </div>  
            </div>  
        @endforeach
    @endif
@endsection