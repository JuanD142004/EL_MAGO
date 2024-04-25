@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Product
@endsection

@section('content')
 <section class="content container-fluid">
      
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12"><div class="float-right mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm" data-placement="right">
                {{ __('Volver') }}
            </a>
        </div>

                <div class="card card-default">
                    <div class="card-header">
  
                        <span class="card-title">{{ __('Crear') }} Producto Nuevo</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('product.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
