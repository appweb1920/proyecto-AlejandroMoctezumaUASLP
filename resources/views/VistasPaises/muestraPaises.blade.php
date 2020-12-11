@extends('layouts.app')

@section('content')
    <h2>Paises</h2>

    @if(Auth::user()->rol == 'Administrador')
        <button class = "btn waves-effect waves-teal amber z-depth-1">  
            <a href="/paises/create">Nuevo Pais</a>
        </button></td>
    @endif

    @if(!is_null($paises))
        @foreach ($paises as $pais)  
            <div class = "row">  
                <div class = "col s10 m10 l10 light-green darken-3 white-text">  
                    <p>[{{$pais->nombre}}]</p>
                    @if(Auth::user()->rol == 'Administrador')
                        <form action="paises/{{$pais->id}}" method="POST" class = "col s12"> 
                        @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button class = "btn waves-effect waves-teal amber z-depth-1">  
                                <a href="/paises/{{$pais->id}}/edit">Edita</a>
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