@extends('layouts.app')

@section('content')
    <h2>Crear Hotel</h2>

    <div class = "row"> 
        <form action="/hoteles" method="POST" class = "col s12"> 
        @csrf
            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Nombre del Hotel" type="text" name="nombre">
                <label for="nombre">Nombre:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Estrellas:</p>
                        <input type="radio" id="estrellas1" name="estrellas" value="1">
                        <label for="estrellas1">1</label><br>
                        <input type="radio" id="estrellas2" name="estrellas" value="2">
                        <label for="estrellas2">2</label><br>
                        <input type="radio" id="estrellas3" name="estrellas" value="3">
                        <label for="estrellas3">3</label><br>
                        <input type="radio" id="estrellas4" name="estrellas" value="4">
                        <label for="estrellas4">4</label><br>
                        <input type="radio" id="estrellas5" name="estrellas" value="5">
                        <label for="estrellas5">5</label><br>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Check In" type="text" name="horaCheckIn">
                <label for="horaCheckIn">Hora Check In:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "Check Out" type="text" name="horaCheckOut">
                <label for="horaCheckOuot">Hora Check Out:</label>
                </div>  
            </div>

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
                <button class="btn waves-effect waves-light purple accent-1" type="submit" name="action">Submit
                    <i class="material-icons right">cloud</i>
                </button>
            </div>
        </form>         
    </div>  
@endsection