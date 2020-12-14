@extends('layouts.app')

@section('content')
    <h2>Crear Tipo de Habitacion</h2>

    <div class = "row"> 
        <form action="/tipoHabitaciones/{{$tipoHabitacion->id}}" method="POST" class = "col s12"> 
        @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="id" value="{{$tipoHabitacion->id}}">

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="nombre" value="{{$tipoHabitacion->nombre}}">
                <label for="nombre">Nombre:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="caracteristicas" value="{{$tipoHabitacion->caracteristicas}}">
                <label for="caracteristicas">Caracteristicas:</label>
                </div>  
            </div>

            <div class="row">
                <button class="btn waves-effect waves-light purple accent-1" type="submit" name="action">Submit
                    <i class="material-icons right">cloud</i>
                </button>
            </div>
        </form>         
    </div>  
@endsection