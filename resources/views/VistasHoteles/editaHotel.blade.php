@extends('layouts.app')

@section('content')
    <h2>Crear Hotel</h2>

    <div class = "row"> 
        <form action="/hoteles/{{$hotel[0]->hotelId}}" method="POST" class = "col s12"> 
        @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="direccionId" value="{{$hotel[0]->direccionId}}">

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="nombre" value="{{$hotel[0]->hotelNombre}}">
                <label for="nombre">Nombre:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Estrellas:</p>
                        <input type="radio" id="estrellas1" name="estrellas" value="1" {{ ($hotel[0]->hotelEstrellas==1)? "checked" : "" }}>
                        <label for="estrellas1">1</label><br>
                        <input type="radio" id="estrellas2" name="estrellas" value="2" {{ ($hotel[0]->hotelEstrellas==2)? "checked" : "" }}>
                        <label for="estrellas2">2</label><br>
                        <input type="radio" id="estrellas3" name="estrellas" value="3" {{ ($hotel[0]->hotelEstrellas==3)? "checked" : "" }}>
                        <label for="estrellas3">3</label><br>
                        <input type="radio" id="estrellas4" name="estrellas" value="4" {{ ($hotel[0]->hotelEstrellas==4)? "checked" : "" }}>
                        <label for="estrellas4">4</label><br>
                        <input type="radio" id="estrellas5" name="estrellas" value="5" {{ ($hotel[0]->hotelEstrellas==5)? "checked" : "" }}>
                        <label for="estrellas5">5</label><br>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="horaCheckIn" value="{{$hotel[0]->hotelCheckIn}}">
                <label for="horaCheckIn">Hora Check In:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="horaCheckOut" value="{{$hotel[0]->hotelCheckOut}}">
                <label for="horaCheckOuot">Hora Check Out:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="calle" value="{{$hotel[0]->direccionCalle}}">
                <label for="calle">Calle:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="numero" value="{{$hotel[0]->direccionNumero}}">
                <label for="numero">Numero:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="ciudad" value="{{$hotel[0]->direccionCiudad}}">
                <label for="ciudad">Ciudad:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="estado" value="{{$hotel[0]->direccionEstado}}">
                <label for="estado">Estado:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input type="text" name="codigoPostal" value="{{$hotel[0]->direccionCodigoPostal}}">
                <label for="codigoPostal">Codigo Postal:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Paises:</p>
                    @foreach ($paises as $pais)  
                        <input type="radio" id="{{$pais->nombre}}" name="idPais" value="{{$pais->id}}"  {{ ($pais->nombre==$hotel[0]->paisNombre)? "checked" : "" }}>
                        <label for="{{$pais->nombre}}">{{$pais->nombre}}</label><br>
                    @endforeach
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