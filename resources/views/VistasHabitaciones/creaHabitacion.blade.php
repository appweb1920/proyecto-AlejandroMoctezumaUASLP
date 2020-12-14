@extends('layouts.app')

@section('content')
    <h2>Crear Habitacion</h2>

    <div class = "row"> 
        <form action="/habitaciones" method="POST" enctype = "multipart/form-data"  class = "col s12"> 
        @csrf
            <div class = "row">  
                <div class = "input-field col s6">  
                <input placeholder = "1000" min = "1" max = "999999" type="number" name="precio">
                <label for="precio">Precio:</label>
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                <p>Imagen:</p>
                <input type="file" name="imagen" accept="image/png, image/jpeg">
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Hoteles:</p>
                    @foreach ($hoteles as $hotel)  
                        <input type="radio" id="{{$hotel->nombre}}" name="idHotel" value="{{$hotel->id}}">
                        <label for="{{$hotel->nombre}}">{{$hotel->nombre}}</label><br>
                    @endforeach
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Tipo:</p>
                    @foreach ($tipoHabitaciones as $tipoHabitacion)  
                        <input type="radio" id="{{$tipoHabitacion->nombre}}" name="idTipoHabitacion" value="{{$tipoHabitacion->id}}">
                        <label for="{{$tipoHabitacion->nombre}}">{{$tipoHabitacion->nombre}}</label><br>
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