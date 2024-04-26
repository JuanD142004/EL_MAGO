@extends('layouts.app')

@section('template_title')
    {{ __('Actualizar') }} Carga
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Carga</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('load.update', $load->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('load.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
