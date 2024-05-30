@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Customer
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row padding-1 p-1">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="card-title">{{ __('Crear') }} Cliente</span>
                                   <a href="{{ route('customer.index') }}" class="btn btn-default btn-sm" style="background-color: #007bff; color: #fff;">
    <i class="fas fa-arrow-left"></i> {{ __('Atrás') }}
</a>

                            </div>
                        </div>    </div>
                    <div class="card-body bg-white">
                        {{-- Mostrar la alerta de error si existe --}}
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('customer.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            
                            @include('customer.form', ['routes' => $routes])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection