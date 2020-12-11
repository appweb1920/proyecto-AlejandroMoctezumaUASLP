@extends('layouts.app')

@section('content')
    <h2>Edita Pais</h2>

    <div class = "row"> 
        <form action="/paises/{{$pais->id}}" method="POST" class = "col s12"> 
        @csrf
            <input type="hidden" name="_method" value="put">

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="nombre" value="{{$pais->nombre}}">
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