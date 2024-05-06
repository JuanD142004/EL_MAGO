@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Product
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="float-right mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm" data-placement="right">
                {{ __('Volver') }}
            </a>
        </div>
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Uactualizar ') }} Producto</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('product.update', $product->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
