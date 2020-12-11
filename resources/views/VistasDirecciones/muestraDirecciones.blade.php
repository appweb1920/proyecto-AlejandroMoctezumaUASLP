@extends('layouts.app')

@section('content')
    <h2>Direcciones</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal amber z-depth-1">  
            <a href="/direcciones/create">Nueva Direccion</a>
        </button></td>
    @endif

    @if(!is_null($direcciones))
        @foreach ($direcciones as $direccion)  
            <div class = "row">  
                <div class = "col s10 m10 l10 light-green darken-3 white-text">  
                    <p>{{$direccion->calle}}, {{$direccion->numero}} [{{$direccion->codigoPostal}}]</p>
                    <p>{{$direccion->ciudad}}, {{$direccion->estado}}, {{$direccion->nombre}}</p>
                    @if(Auth::user()->rol == 'Administrador')
                        <form action="direcciones/{{$direccion->id}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal amber z-depth-1">  
                                <a href="/direcciones/{{$direccion->id}}/edit">Edita</a>
                            </button></td>  
                            <button class = "btn waves-effect waves-teal amber z-depth-1" type="submit" name="action">
                                Borrar
                            </button></td>  
                        </form>
                    @endif
                </div>  
            </div>  
        @endforeach
    @endif
@endsection