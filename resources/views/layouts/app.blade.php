<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container d-flex align-items-center">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 20px;">
                    <img src="{{ asset('logo-removebg-preview.png') }}" alt="Logo" style="max-width: 80px; margin-right: 10px;">
                    <h1 style="color: black; font-family: 'ALGERIAN', cursive; font-size: 25px;margin-left: 90px;margin-top: -70px;">DISTRIBUCIONES EL MAGO</h1>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">{{ __('Usuarios') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('supplier.index') }}">{{ __('Proveedores') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employee.index') }}">{{ __('Empleados') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('Productos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('truck_type.index') }}">{{ __('Tipo de Camion') }}</a>
                                </li>
                                <li class="nav-item"> 
                                     <a class="nav-link" href="{{route('customer.index')}}">{{__('Clientes')}}</a>
                                </li>
                                <li class="nav-item"> 
                                    <a class="nav-link" href="{{route('load.index')}}">{{__('Carga')}}</a>
                                </li>
                                 <li class="nav-item">
                                  <a class="nav-link" href="{{ route('route.index') }}">{{ __('Rutas') }}</a>
                                </li>
                                <li class="nav-item">
                                 <a class="nav-link" href="{{ route('departament.index') }}">{{ __('Departamentos') }}</a>
                                </li>
                                <li class="nav-item">
                                 <a class="nav-link" href="{{ route('municipality.index') }}">{{ __('Municipios') }}</a>
                                </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Script para alternar la visibilidad de la contraseña -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordField = document.querySelector('#password');
        const togglePassword = document.querySelector('.toggle-password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        });
    });
    </script>
    @yield('script')
</body>
</html>
