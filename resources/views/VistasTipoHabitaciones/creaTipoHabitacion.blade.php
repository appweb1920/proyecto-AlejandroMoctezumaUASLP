@extends('layouts.app')

@section('content')
    <h2>Crear Tipo de Habitacion</h2>

    <div class = "row"> 
        <form action="/tipoHabitaciones" method="POST" class = "col s12"> 
        @csrf
            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Estandar" type="text" name="nombre">
                <label for="nombre">Nombre:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "mucho texto" type="text" name="caracteristicas">
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