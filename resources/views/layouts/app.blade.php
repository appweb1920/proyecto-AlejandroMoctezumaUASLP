<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Materialize Scripts -->
    <link rel = "stylesheet"  href = "https://fonts.googleapis.com/icon?family=Material+Icons">  
    <link rel = "stylesheet"  href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">  
    <script type = "text/javascript"  src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>             
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>   
</head>

<body class="container">
    <div id="app">
        <!-- Navbar -->
        <div class = "row" style = "width:100%;">  
            <div class = "col s12 m12 l12">  
                <nav>  
                    <div class="nav-wrapper light-green">  
                        <!-- Right Side Of Navbar -->
                        <ul class="right">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                        <!-- Left Side Of Navbar -->
                        @guest
                            <ul id="nav-mobile" class="left">   
                                <li><a href="/">PORTADA</a></li> 
                            </ul>  
                        @else
                            <ul id="nav-mobile" class="left">  
                                <li><a href="/">PORTADA</a></li>
                                <li><a href="/habitaciones">Habitaciones</a></li> 
                                <li><a href="/reservas">Reserva</a></li>  
                                @if(Auth::user()->rol == 'Administrador')
                                    <li><a href="/paises">Paises</a></li>
                                    <li><a href="/direcciones">Direcciones</a></li>
                                    <li><a href="/tipoHabitaciones">Tipo Habitaciones</a></li>
                                    <li><a href="/hoteles">Hoteles</a></li>
                                @endif  
                            </ul>  
                        @endguest
                    </div>  
                </nav>  
            </div>  
        </div> 

        <!-- Contenido de la Pagina -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
