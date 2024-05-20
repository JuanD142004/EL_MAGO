@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Route
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">  
        <div class="row">
             <div class="col-md-12">
    <div class="float-right mb-3">
        <a href="{{ route('route.index') }}" class="btn btn-primary btn-sm" data-placement="right">
            {{ __('Volver') }}
        </a>
    </div>
</div>
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Ruta</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('route.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('route.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection