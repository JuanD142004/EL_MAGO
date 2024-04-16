@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); min-height: 100vh;">
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border-radius: 10px 10px 0 0; color: #fff; font-family: Algerian;">{{ __('REGISTRAR') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3" style="color: #333; font-family: Times New Roman;">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 " style="color: #333; font-family: Times New Roman;">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 " style="color: #333; font-family: Times New Roman;">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 " style="color: #333; font-family: Times New Roman;">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3 " style="color: #333; font-family: Times New Roman;">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="user">Usario</option>
                                    
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 ">
                        <div class="col-md-6 offset-md-4" style="border-radius: 5px;">
    <button type="submit" class="btn btn-primary" style="background: linear-gradient(to right, #00ffff 0%, #20115b 100%); border: none; font-family: algerian;">
        {{ __('Registrar') }}
    </button>
</div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection