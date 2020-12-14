@extends('layouts.app')

@section('content')
    <h2>Direcciones</h2>

    @if(!is_null($direcciones))
        @foreach ($direcciones as $direccion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 light-green darken-3 white-text">  
                    <p>{{$direccion->calle}}, {{$direccion->numero}} [{{$direccion->codigoPostal}}]</p>
                    <p>{{$direccion->ciudad}}, {{$direccion->estado}}, {{$direccion->nombre}}</p>
                </div>  
            </div>  
        @endforeach
    @endif
@endsection