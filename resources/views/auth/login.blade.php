@extends('layouts.app')

@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); min-height: 100vh;">
    <div class="row">
        <div class="col-md-4">
            <!-- Columna para el Slogan -->
            <div class="d-flex flex-column justify-content-center align-items-center">
                <hr style="border: 0; height: 10px; background-color: blue; margin:40px 0;">
                <h1 style="color: white; font-family: 'ALGERIAN', cursive;">DISTRIBUCIONES EL MAGO</h1>
                <p style="font-family: 'Brush Script MT', sans-serif; font-size: 30px; letter-spacing: 0px; color: white;"><i>Excelencia, Calidad y Compromiso</i></p>

            </div>
        </div>
        <div class="col-md-4">
            <!-- Columna para el Formulario de Inicio de Sesión -->
            <div class="card" style="background: rgba(255, 255, 255, 0.7); border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);">
                    <div class="card-header" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border-radius: 10px 10px 0 0; color: #fff; font-family: 'algerian;">{{ __('INICIAR SESIÓN') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class=card-header style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border-radius: 10px 10px 0 0; color: #fff; font-family: Times New Roman;";>
                            <label for="email" class="form-label" style="color: #333;">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border: none; background: transparent; color: #333;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border-radius: 10px 10px 0 0; color: #fff; font-family: Times New Roman;">
                            <label for="password" class="form-label" style="color: #333;">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border: none; background: transparent; color: #333;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: #333; font-family: Times New Roman;">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary" style="border-radius: 5px; background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border: none; font-family: algerian;">
                            {{ __('INICIAR SESIÓN') }}
                        </button>

                        @if(Session::has('registration_success'))
                            <div class="alert alert-success mt-3">
                                {{ Session::get('registration_success') }}
                            </div>
                        @endif

                        @if (Route::has('password.request'))
                            <a class="btn btn-link mt-3" href="{{ route('password.request') }}" style="color: blue; font-family: Times New Roman; ">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Columna para la Imagen -->
            <img src="{{ asset('fondo.jpg') }}" alt="Logo" style="max-width: 370px; margin-right: 10px;">
        </div>
    </div>
</div>

</body>

@endsection
