@extends('layouts.app')

@section('content')
    <h2>Crear Direccion</h2>

    <div class = "row"> 
        <form action="/direcciones/{{$direccion[0]->id}}" method="POST" class = "col s12"> 
        @csrf
            <input type="hidden" name="_method" value="put">

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="calle" value="{{$direccion[0]->calle}}">
                <label for="calle">Calle:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="numero" value="{{$direccion[0]->numero}}">
                <label for="numero">Numero:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="ciudad" value="{{$direccion[0]->ciudad}}">
                <label for="ciudad">Ciudad:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="estado" value="{{$direccion[0]->estado}}">
                <label for="estado">Estado:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="codigoPostal" value="{{$direccion[0]->codigoPostal}}">
                <label for="codigoPostal">Codigo Postal:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Paises:</p>
                    @foreach ($paises as $pais)  
                        <input type="radio" id="{{$pais->nombre}}" name="idPais" value="{{$pais->id}}" {{ ($pais->nombre==$direccion[0]->nombre)? "checked" : "" }}>
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