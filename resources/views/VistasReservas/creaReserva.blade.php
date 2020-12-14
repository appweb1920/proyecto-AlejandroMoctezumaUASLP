@extends('layouts.app')

@section('content')
    <h2>Haz tu Reservación</h2>

    <h3>Verificar Detalles</h3>    
        <div class = "row">
            @if(!is_null($habitaciones))
                @foreach ($habitaciones as $habitacion)
                    <div class="col s10 m10 l10 red accent-1 black-text">
                        <p>{{$habitacion->hotelNombre}} [{{$habitacion->hotelEstrellas}} estrellas] </p>
                        <p>{{$habitacion->paisNombre}}, {{$habitacion->direccionEstado}}, {{$habitacion->direccionCiudad}} [{{$habitacion->tipoNombre}}]</p>
                        <p>{{$habitacion->direccionCalle}} {{$habitacion->direccionNumero}}, C.P. {{$habitacion->direccionCodigoPostal}}</p>
                        <p>[{{$habitacion->hotelCheckIn}} - {{$habitacion->hotelCheckOut}}] ${{$habitacion->habitacionPrecio}}</p>
                        <img class="responsive-img" src="{{asset('/storage/imgs/'. $habitacion->habitacionImagen)}}">
                    </div>    
                @endforeach   
            @endif
        </div>  

        <div class = "row"> 
            @if(!is_null($total))
                <div class="col s10 m10 l10">
                    <form action="/reservas" method="POST" class = "col s12"> 
                    @csrf
                        <div class = "row">  
                            <div class = "input-field col s6">  
                            <input placeholder = "nombreTitular" type="text" name="nombreTitular">
                            <label for="nombreTitular">Nombre del Titular:</label>
                            </div>  
                        </div>  

                        <div class = "row">  
                            <div class = "input-field col s6">  
                            <input placeholder = "apellidosTitular" type="text" name="apellidosTitular">
                            <label for="apellidosTitular">Apellidos del Titular:</label>
                            </div>  
                        </div>  

                        <div class = "row">  
                            <div class = "input-field col s6">  
                            <input placeholder = "peticiones" type="text" name="peticiones">
                            <label for="peticiones">Peticiones:</label>
                            </div>  
                        </div> 

                        <p>Total: ${{$total}}</p>

                        <div class="row">
                            <button class="btn waves-effect waves-light purple accent-1" type="submit" name="action">Hacer Reservacion
                                <i class="material-icons right">cloud</i>
                            </button>
                        </div>
                    </form>   
                </div> 
            @endif
        </div>
@endsection