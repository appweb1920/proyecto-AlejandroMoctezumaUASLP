@extends('layouts.app')

@section('content')
    <h2>Crear Direccion</h2>

    <div class = "row"> 
        <form action="/direcciones" method="POST" class = "col s12"> 
        @csrf
            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Calle" type="text" name="calle">
                <label for="calle">Calle:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "1234" type="text" name="numero">
                <label for="numero">Numero:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Ciudad" type="text" name="ciudad">
                <label for="ciudad">Ciudad:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Estado" type="text" name="estado">
                <label for="estado">Estado:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "12345" type="text" name="codigoPostal">
                <label for="codigoPostal">Codigo Postal:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Paises:</p>
                    @foreach ($paises as $pais)  
                        <input type="radio" id="{{$pais->nombre}}" name="idPais" value="{{$pais->id}}">
                        <label for="{{$pais->nombre}}">{{$pais->nombre}}</label><br>
                    @endforeach
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