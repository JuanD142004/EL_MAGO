@extends('layouts.app')

@section('template_title')
    {{ __('Crear') }} Carga
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="card-title">{{ __('Crear') }} Carga</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('load.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('load.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
