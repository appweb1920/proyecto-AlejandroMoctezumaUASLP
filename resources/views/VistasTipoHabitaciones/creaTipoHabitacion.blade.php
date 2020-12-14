@extends('layouts.app')

@section('content')
    <h2>Crear Tipo de Habitacion</h2>

    <div class = "row"> 
        <form action="/tipoHabitaciones" method="POST" enctype = "multipart/form-data" class = "col s12"> 
        @csrf
            @error('error')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

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

            <div class = "row">  
                <div class = "input-field col s6">  
                <p>Imagen 01:</p>
                <input type="file" name="imagen01" accept="image/png, image/jpeg">
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6"> 
                <p>Imagen 02:</p> 
                <input type="file" name="imagen02" accept="image/png, image/jpeg">
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <p>Imagen 03:</p> 
                <input type="file" name="imagen03" accept="image/png, image/jpeg">
                </div>  
            </div>

            <div class="row">
                <button class="btn waves-effect waves-light amber" type="submit" name="action">Submit
                    <i class="material-icons right">cloud</i>
                </button>
            </div>
        </form>         
    </div>  
@endsection