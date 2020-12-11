@extends('layouts.app')

@section('content')
    <h2>Crear Pais</h2>

    <div class = "row"> 
        <form action="/paises" method="POST" class = "col s12"> 
        @csrf
            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Pais" type="text" name="nombre">
                <label for="nombre">Nombre del Pais:</label>
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