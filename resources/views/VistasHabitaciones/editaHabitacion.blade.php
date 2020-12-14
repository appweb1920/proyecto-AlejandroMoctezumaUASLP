@extends('layouts.app')

@section('content')
    <h2>Editar Habitacion</h2>

    <div class = "row"> 
        <form action="/habitaciones/{{$habitacion[0]->id}}" method="POST" enctype = "multipart/form-data"  class = "col s12"> 
        @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="id" value="{{$habitacion[0]->id}}">

            <div class = "row">  
                <div class = "input-field col s6">  
                <input min = "1" max = "999999" type="number" name="precio" value="{{$habitacion[0]->precio}}">
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
                        <input type="radio" id="{{$hotel->nombre}}" name="idHotel" value="{{$hotel->id}}"  {{ ($hotel->id==$habitacion[0]->idHotel)? "checked" : "" }}>
                        <label for="{{$hotel->nombre}}">{{$hotel->nombre}}</label><br>
                    @endforeach
                </div>  
            </div>

            <div class = "row">  
                <div class = "input-field col s6">  
                    <p>Tipo:</p>
                    @foreach ($tipoHabitaciones as $tipoHabitacion)  
                        <input type="radio" id="{{$tipoHabitacion->nombre}}" name="idTipoHabitacion" value="{{$tipoHabitacion->id}}"  {{ ($tipoHabitacion->id==$habitacion[0]->idHotel)? "checked" : "" }}>
                        <label for="{{$tipoHabitacion->nombre}}">{{$tipoHabitacion->nombre}}</label><br>
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