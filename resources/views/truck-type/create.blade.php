@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Truck Type
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
<div class="card card-default">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="card-title">{{ __('Crear') }} Tipo de Camión</span>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-default btn-sm" style="background-color: #007bff; color: #fff;"><i class="fas fa-arrow-left"></i> {{ __('Atrás') }}</a>
        </div>
    </div>
    <!-- Aquí va el resto del contenido del formulario -->
</div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('truck_type.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('truck-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
