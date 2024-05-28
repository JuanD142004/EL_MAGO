@extends('layouts.app')

@section('template_title')
    {{ $load->name ?? __('Mostrar') . " " . __('Carga') }}
@endsection

@section('content')
    <style>
        body{
        background-image: url('/img/El_mago.jpg');
        background-size: cover; /* Ajusta la imagen para que cubra todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        height: 100vh; /* Ajusta la altura al 100% de la ventana */
        width: 100vw; /* Ajusta el ancho al 100% de la ventana */
    }
    </style>
<body>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Carga</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('load.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha:</strong>
                            {{ $load->date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Producto:</strong>
                            {{ $load->products_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $load->amount }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Ruta:</strong>
                            {{ $load->routes_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Tipo de Camión:</strong>
                            {{ $load->truck_types_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
</body>