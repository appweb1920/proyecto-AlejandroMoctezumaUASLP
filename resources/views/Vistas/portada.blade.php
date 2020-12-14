@extends('layouts.app')

@section('content')
    <h2>Bienvenido</h2>
    <p>Especifique su tiempos de Check-In y Check-Out</p>

    <div class = "row"> 
        <div class = "col s10 m10 l10 orange accent-1 black-text">  
            <form action="/habitacionesFiltradas" method="POST" class = "col s12"> 
            @csrf
                <div class = "row">  
                    <div class = "input-field col s6">  
                    <p>Fecha de Check-In:</p>
                    <input type="date" name="checkIn">
                    </div>  
                </div>  

                <div class = "row">  
                    <div class = "input-field col s6">  
                    <p>Fecha de Check-Out:</p>
                    <input type="date" name="checkOut">
                    </div>  
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light purple accent-1" type="submit" name="action">Submit
                        <i class="material-icons right">cloud</i>
                    </button>
                </div>
            </form>   
        </div>      
    </div>  
@endsection