@extends('layouts.app')

@section('template_title')
    {{ $employee->name ?? __('Show') . " " . __('Employee') }}
@endsection

@section('content')

    <section class="d-flex justify-content-center align-items-center min-vh-50">
        <div class="row">
            <div class="col-md-15">
            
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Empleado {{ $employee->user->name }}</span>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $employee->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Correo Registrado:</strong>
                            {{ $employee->user->email }}
                        </div>
                        <div class="form-group">
                            <strong>Genero:</strong>
                            {{ $employee->gender }}
                        </div>
                        <div class="form-group">
                            <strong>Estado Civil:</strong>
                            {{ $employee->civil_status }}
                        </div>
                        <div class="form-group">
                            <strong>EPS:</strong>
                            {{ $employee->eps }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $employee->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Hijos:</strong>
                            {{ $employee->children }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $employee->home }}
                        </div>
                        <div class="form-group">
                            <strong>Ruta Asignada:</strong>
                            {{ $employee->route->route_name }}
                        </div>
                        <br>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employee.index') }}"> {{ __('Volver') }}</a>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
